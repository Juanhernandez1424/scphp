<?php

namespace App\Services;

use App\DTOs\StoreReservaDTO;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class ReservaService
{
    public function getAll()
    {
        return Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo'
        ])
            ->orderBy('id_reserva', 'desc')
            ->get();
    }

    public function getById(int $idReserva): Reserva
    {
        return Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo'
        ])->findOrFail($idReserva);
    }

    public function getByDate(string $fecha)
    {
        return Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo'
        ])
            ->where('fecha', $fecha)
            ->orderBy('hora', 'asc')
            ->get();
    }

    public function getByEtapaLavado(StoreReservaRequest $dto): Reserva
    {
        return Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo'
        ])
            ->where('etapa_lavado', $dto->etapaLavado)
            ->orderBy('hora', 'asc')
            ->get();
    }

    /**
     * Registra una reserva.
     * 
     * @param StoreReservaDTO $dto
     * @return Reserva
     * @throws Exception
     */
    public function registrarReserva(StoreReservaDTO $dto): Reserva
    {
        return DB::transaction(function () use ($dto) {
            $reserva = Reserva::create([
                'no_documento_cliente' => $dto->noDocumentoCliente,
                'placa_vehiculo' => $dto->placaVehiculo,
                'no_documento_colaborador' => $dto->noDocumentoColaborador,
                'fecha' => $dto->fecha,
                'hora' => $dto->hora,
                'id_plan' => $dto->idPlan,
                'id_servicio' => $dto->idServicio,
                'id_tipo_vehiculo' => $dto->idTipoVehiculo,
                'etapa_lavado' => $dto->etapaLavado ?? 'Pendiente',
                'fotos_vehiculo' => $dto->fotosVehiculo,
                'estado_lavado' => true
            ]);

            return $reserva;
        });
    }

    public function activarReserva(int $idReserva): Reserva
    {
        return DB::transaction(function () use ($idReserva) {
            $reserva = Reserva::findOrFail($idReserva);

            if ($reserva->etapa_lavado !== 'Pendiente') {
                throw new \Exception("No se puede activar. La reserva está en etapa: {$reserva->etapa_lavado}");
            }

            $reserva->update(['etapa_lavado' => 'Activa']);

            return $reserva->load([
                'cliente.usuario',
                'vehiculo',
                'colaborador.usuario',
                'servicio'
            ]);
        });
    }

    public function iniciarReserva(int $idReserva): Reserva
    {
        return DB::transaction(function () use ($idReserva) {
            $reserva = Reserva::findOrFail($idReserva);

            if ($reserva->etapa_lavado !== 'Activa') {
                throw new \Exception("No se puede iniciar. La reserva está en etapa: {$reserva->etapa_lavado}");
            }

            $reserva->update(['etapa_lavado' => 'En Proceso']);

            return $reserva->load([
                'cliente.usuario',
                'vehiculo',
                'colaborador.usuario',
                'servicio'
            ]);
        });
    }

    public function finalizarReserva(int $idReserva): Reserva
    {
        return DB::transaction(function () use ($idReserva) {
            $reserva = Reserva::findOrFail($idReserva);

            if ($reserva->etapa_lavado !== 'En Proceso') {
                throw new \Exception("No se puede finalizar. La reserva está en etapa: {$reserva->etapa_lavado}");
            }

            $reserva->update(['etapa_lavado' => 'Finalizada']);

            return $reserva->load([
                'cliente.usuario',
                'vehiculo',
                'colaborador.usuario',
                'servicio'
            ]);
        });
    }

    public function cancelarReserva(int $idReserva): Reserva
    {
        return DB::transaction(function () use ($idReserva) {
            $reserva = Reserva::findOrFail($idReserva);

            if ($reserva->etapa_lavado === 'Cancelada') {
                return $reserva->load([
                    'cliente.usuario',
                    'vehiculo',
                    'colaborador.usuario',
                    'servicio'
                ]);
            }

            if (in_array($reserva->etapa_lavado, ['En Proceso', 'Finalizada'])) {
                throw new \Exception("No se puede cancelar. La reserva ya está finalizada.");
            }

            $reserva->update(['etapa_lavado' => 'Cancelada']);

            return $reserva->load([
                'cliente.usuario',
                'vehiculo',
                'colaborador.usuario',
                'servicio'
            ]);
        });
    }
}

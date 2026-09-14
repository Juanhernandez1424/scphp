<?php

namespace App\Services;

use App\DTOs\StoreReservaDTO;
use App\Http\Requests\StoreReservaRequest;
use App\Models\Reserva;
use App\Models\ComprobantePago;
use App\Models\MetodoPago;
use Illuminate\Support\Facades\DB;

class ReservaService
{
    public function getAll(?int $colaboradorId = null)
    {
        $query = Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo',
            'comprobantePago.metodoPago'
        ]);

        if ($colaboradorId !== null) {
            $query->where('no_documento_colaborador', $colaboradorId);
        }

        return $query->orderBy('id_reserva', 'desc')->get();
    }

    public function getById(int $idReserva, ?int $colaboradorId = null): Reserva
    {
        return Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo'
        ])
            ->when($colaboradorId !== null, fn($query) => $query->where('no_documento_colaborador', $colaboradorId))
            ->findOrFail($idReserva);
    }

    public function getByDate(string $fecha, ?int $colaboradorId = null)
    {
        $query = Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador.usuario',
            'plan',
            'servicio',
            'tipoVehiculo'
        ])->where('fecha', $fecha);

        if ($colaboradorId !== null) {
            $query->where('no_documento_colaborador', $colaboradorId);
        }

        return $query->orderBy('hora', 'desc')->get();
    }

    public function colaboradorDisponible(int $colaboradorId, string $fecha, string $hora, ?int $exceptoReservaId = null): bool
    {
        return !Reserva::where('no_documento_colaborador', $colaboradorId)
            ->where('fecha', $fecha)
            ->where('hora', $hora)
            ->where('etapa_lavado', '!=', 'Cancelada')
            ->when($exceptoReservaId !== null, fn($query) => $query->where('id_reserva', '!=', $exceptoReservaId))
            ->exists();
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
            ->orderBy('hora', 'desc')
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
            if (!$this->colaboradorDisponible(
                $dto->noDocumentoColaborador,
                $dto->fecha,
                $dto->hora
            )) {
                throw new \RuntimeException(
                    'El colaborador ya tiene una reserva para esa fecha y hora. Cambia de colaborador, hora o día.'
                );
            }

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
    public function actualizarEtapaLavado(int $idReserva, string $etapa): Reserva
    {
        $reserva = Reserva::findOrFail($idReserva);
        $reserva->update(['etapa_lavado' => $etapa]);

        return $reserva->fresh();
    }

    public function actualizarReserva(int $idReserva, array $datos, ?int $clienteId = null): Reserva
    {
        return DB::transaction(function () use ($idReserva, $datos, $clienteId) {
            $reserva = Reserva::query()
                ->when($clienteId !== null, fn($query) => $query->where('no_documento_cliente', $clienteId))
                ->lockForUpdate()
                ->findOrFail($idReserva);

            if ($reserva->etapa_lavado !== 'Pendiente') {
                throw new \RuntimeException('Solo se pueden editar reservas en estado Pendiente.');
            }

            if (!$this->colaboradorDisponible(
                (int) $datos['no_documento_colaborador'],
                $datos['fecha'],
                $datos['hora'],
                $idReserva
            )) {
                throw new \RuntimeException('El colaborador ya tiene una reserva para esa fecha y hora.');
            }

            $reserva->update($datos);

            return $reserva->load(['cliente.usuario', 'vehiculo', 'colaborador.usuario', 'servicio', 'tipoVehiculo']);
        });
    }

    public function obtenerRecibo(int $idReserva, ?int $clienteId = null): Reserva
    {
        return Reserva::with([
            'cliente.usuario',
            'vehiculo',
            'colaborador.usuario',
            'servicio',
            'comprobantePago.metodoPago'
        ])
            ->where('etapa_lavado', 'Finalizada')
            ->when($clienteId !== null, fn($query) => $query->where('no_documento_cliente', $clienteId))
            ->findOrFail($idReserva);
    }

    public function finalizarReserva(int $idReserva, ?int $colaboradorId = null, ?string $metodoPago = null): Reserva
    {
        return DB::transaction(function () use ($idReserva, $colaboradorId, $metodoPago) {
            $reserva = Reserva::query()
                ->when($colaboradorId !== null, fn($query) => $query->where('no_documento_colaborador', $colaboradorId))
                ->lockForUpdate()
                ->findOrFail($idReserva);

            if ($reserva->etapa_lavado !== 'En Proceso') {
                throw new \Exception("No se puede finalizar. La reserva está en etapa: {$reserva->etapa_lavado}");
            }

            $reserva->update(['etapa_lavado' => 'Finalizada']);

            if ($metodoPago !== null) {
                $metodo = MetodoPago::firstOrCreate(
                    ['nombre_metodo_pago' => $metodoPago],
                    ['estado_metodo_pago' => true]
                );

                ComprobantePago::updateOrCreate(
                    ['id_reserva' => $reserva->id_reserva],
                    ['id_metodo_pago' => $metodo->id_metodo_pago]
                );
            }

            return $reserva->load(['cliente.usuario', 'vehiculo', 'colaborador.usuario', 'servicio', 'comprobantePago.metodoPago']);
        });
    }

    public function activarReserva(int $idReserva, ?int $colaboradorId = null): Reserva
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

    public function iniciarReserva(int $idReserva, ?int $colaboradorId = null): Reserva
    {
        return DB::transaction(function () use ($idReserva, $colaboradorId) {
            $reserva = Reserva::query()
                ->when($colaboradorId !== null, fn($query) => $query->where('no_documento_colaborador', $colaboradorId))
                ->findOrFail($idReserva);

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

    public function cancelarReserva(int $idReserva, ?int $colaboradorId = null): Reserva
    {
        return DB::transaction(function () use ($idReserva, $colaboradorId) {
            $reserva = Reserva::query()
                ->when($colaboradorId !== null, fn($query) => $query->where('no_documento_colaborador', $colaboradorId))
                ->findOrFail($idReserva);

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

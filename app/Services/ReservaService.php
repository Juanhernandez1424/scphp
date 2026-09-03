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
            'colaborador',
            'plan',
            'servicio',
            'tipo_vehiculo'
        ])
            ->orderBy('id_reserva', 'desc')
            ->get();
    }

    public function getById(int $idReserva): Reserva
    {
        return Reserva::with([
            'cliente',
            'vehiculo',
            'colaborador',
            'plan',
            'servicio',
            'tipo_vehiculo'
        ])->findOrFail($idReserva);
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
}

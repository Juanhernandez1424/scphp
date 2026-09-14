<?php

namespace App\Services;

use App\DTOs\StoreComprobantePagoDTO;
use App\Models\ComprobantePago;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class ComprobantePagoService
{
    public function registrar(StoreComprobantePagoDTO $dto): ComprobantePago
    {
        return DB::transaction(function () use ($dto) {
            $reserva = Reserva::findOrFail($dto->idReserva);

            if ($reserva->etapa_lavado !== 'Finalizada') {
                throw new \RuntimeException('Solo se puede generar el comprobante de una reserva finalizada.');
            }

            return ComprobantePago::updateOrCreate(
                ['id_reserva' => $reserva->id_reserva],
                ['id_metodo_pago' => $dto->idMetodoPago]
            )->load([
                'reserva.servicio',
                'reserva.cliente.usuario',
                'reserva.vehiculo',
                'metodoPago'
            ]);
        });
    }

    public function obtenerPorReserva(int $idReserva): ComprobantePago
    {
        return ComprobantePago::with([
            'reserva.cliente.usuario',
            'reserva.vehiculo',
            'reserva.colaborador.usuario',
            'reserva.servicio',
            'metodoPago'
        ])->where('id_reserva', $idReserva)->firstOrFail();
    }
}

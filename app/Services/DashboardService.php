<?php

namespace App\Services;

use App\Models\Reserva;

class DashboardService
{
    public function obtenerMetricas(string $fecha): array
    {
        $reservasDelDia = Reserva::query()
            ->whereDate('fecha', $fecha);

        $finalizados = (clone $reservasDelDia)
            ->where('etapa_lavado', 'Finalizada');

        $pendientes = (clone $reservasDelDia)
            ->whereIn('etapa_lavado', ['Pendiente', 'Activa', 'En Proceso']);

        return [
            'fecha' => $fecha,
            'lavados_finalizados' => (clone $finalizados)->count(),
            'ingresos' => (float) $finalizados
                ->join('servicio', 'servicio.id_servicio', '=', 'reserva.id_servicio')
                ->sum('servicio.costo_servicio'),
            'servicios_pendientes' => (clone $pendientes)->count(),
        ];
    }
}

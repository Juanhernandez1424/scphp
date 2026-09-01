<?php

namespace App\Services;

use App\Models\Novedad;

class NovedadService
{
    public function getAll()
    {
        return Novedad::with([
            'cliente',
            'colaborador',
            'reserva'
        ])
            ->orderBy('id_novedad', 'desc')
            ->get();
    }
}

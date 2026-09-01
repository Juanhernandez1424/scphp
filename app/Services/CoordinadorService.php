<?php

namespace App\Services;

use App\Models\Coordinador;

class CoordinadorService
{
    public function getAll()
    {
        return Coordinador::with([
            'usuario'
        ])
            ->orderBy('id_usuario', 'desc')
            ->get();
    }
}

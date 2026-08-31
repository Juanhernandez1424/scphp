<?php

namespace App\Services;

use App\Models\Colaborador;

class ColaboradorService
{
    public function getAll()
    {
        return Colaborador::with([
            'usuario'
        ])
        ->orderBy('id_usuario', 'desc')
        ->get();
    }   
}
<?php

namespace App\Services;

use App\Models\Administrador;

class AdministradorService
{
    public function getAll()
    {
        return Administrador::with([
            'usuario'
        ])->get();
    }   
}
<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function getAll()
    {
        return Cliente::with([
            'usuario'
        ])->get();
    }   
}
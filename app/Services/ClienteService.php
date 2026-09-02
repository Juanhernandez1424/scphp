<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function getAll()
    {
        return Cliente::with([
            'usuario',
            'vehiculo'
        ])
            ->orderBy('id_usuario', 'desc')
            ->get();
    }

    public function getById(string $noDocumentoCliente): Cliente
    {
        return Cliente::with([
            'usuario',
            'vehiculo'
        ])->findOrFail($noDocumentoCliente);
    }
}

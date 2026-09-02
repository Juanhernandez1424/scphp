<?php

namespace App\Services;

use App\Models\Administrador;

class AdministradorService
{
    public function getAll()
    {
        return Administrador::with([
            'usuario'
        ])
        ->orderBy('id_usuario', 'desc')
        ->get();
    }

    public function getById(string $noDocumentoAdministrador): Administrador
    {
        return Administrador::with([
            'usuario'
        ])->findOrFail($noDocumentoAdministrador);
    }
}
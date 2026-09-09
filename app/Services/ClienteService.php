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

    public function getByTipoNumeroDocumento(string $tipoDocumento, string $noDocumentoCliente)
    {
        return Cliente::where('no_documento_cliente', $noDocumentoCliente)
            ->whereHas('usuario', function ($query) use ($tipoDocumento) {
                $query->where('tipo_documento', $tipoDocumento);
            })
            ->with([
                'usuario',
                'vehiculo'
            ])
            ->first();
    }

    public function existePorDocumento(string $noDocumentoCliente): bool
    {
        return Cliente::where('no_documento_cliente', $noDocumentoCliente)->exists();
    }
}

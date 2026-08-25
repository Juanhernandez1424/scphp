<?php

namespace App\DTOs;

class StoreClienteDTO
{
    public function __construct(
        public int $numeroDocumentoCliente,
        public int $idUsuario
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            numeroDocumentoCliente: (int)$data['no_documento_usuario'],
            idUsuario: (int)$data['id_usuario']
        );
    }
}   
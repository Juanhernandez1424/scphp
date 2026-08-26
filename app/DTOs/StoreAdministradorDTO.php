<?php

namespace App\DTOs;

class StoreAdministradorDTO
{
    public function __construct(
        public int $numeroDocumentoAdministrador,
        public int $idUsuario
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            numeroDocumentoAdministrador: (int)$data['no_documento_administrador'],
            idUsuario: (int)$data['id_usuario']
        );
    }
}
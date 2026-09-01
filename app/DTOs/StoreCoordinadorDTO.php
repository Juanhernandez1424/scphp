<?php

namespace App\DTOs;

class StoreCoordinadorDTO
{
    public function __construct(
        public int $numeroDocumentoCoordinador,
        public int $idUsuario
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            numeroDocumentoCoordinador: (int)$data['no_documento_coordinador'],
            idUsuario: (int)$data['id_usuario']
        );
    }
}

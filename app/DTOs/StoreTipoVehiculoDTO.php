<?php

namespace App\DTOs;

class StoreTipoVehiculoDTO
{
    public function __construct(
        public string $nombre_tipo_vehiculo
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            nombre_tipo_vehiculo: $data['nombre_tipo_vehiculo']
        );
    }
}

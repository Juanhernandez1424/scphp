<?php

namespace App\DTOs;

class MetodoPagoDTO
{
    public function __construct(
        public int $idMetodoPago,
        public string $nombreMetodoPago
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            idMetodoPago: (int) $data['id_metodo_pago'],
            nombreMetodoPago: $data['nombre_metodo_pago']
        );
    }
}

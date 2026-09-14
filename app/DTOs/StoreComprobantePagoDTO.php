<?php

namespace App\DTOs;

class StoreComprobantePagoDTO
{
    public function __construct(
        public int $idReserva,
        public int $idMetodoPago
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            idReserva: (int) $data['id_reserva'],
            idMetodoPago: (int) $data['id_metodo_pago']
        );
    }
}

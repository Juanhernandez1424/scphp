<?php

namespace App\DTOs;

class StoreNovedadDTO
{
    public function __construct(
        public string $tipoNovedad,
        public string $descripcionNovedad,
        public string $ticketNovedad,
        public int $noDocumentoColaborador,
        public int $noDocumentoCliente,
        public int $idReserva
    ) {}

    // Este método toma los datos limpios del Request anterior y los transforma en este objeto DTO
    public static function fromRequest(array $data): self
    {
        return new self(
            tipoNovedad: $data['tipo_novedad'],
            descripcionNovedad: $data['descripcion_novedad'],
            ticketNovedad: $data['ticket_novedad'],
            noDocumentoColaborador: (int)$data['no_documento_colaborador'],
            noDocumentoCliente: (int)$data['no_documento_cliente'],
            idReserva: (int)$data['id_reserva']
        );
    }
}

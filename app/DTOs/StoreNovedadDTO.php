<?php

namespace App\DTOs;

class StoreNovedadDTO
{
    public function __construct(
        public string $tipoNovedad,
        public string $descripcionNovedad,
        public int $noDocumentoColaborador,
        public int $noDocumentoCliente,
        public ?string $etapoNovedad,
        public int $idReserva
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            tipoNovedad: $data['tipo_novedad'],
            descripcionNovedad: $data['descripcion_novedad'],
            noDocumentoColaborador: (int)$data['no_documento_colaborador'],
            noDocumentoCliente: (int)$data['no_documento_cliente'],
            etapoNovedad: $data['etapo_novedad'] ?? null,
            idReserva: (int)$data['id_reserva']
        );
    }
}
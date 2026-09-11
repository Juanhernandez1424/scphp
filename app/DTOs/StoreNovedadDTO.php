<?php

namespace App\DTOs;

class StoreNovedadDTO
{
    public function __construct(
        public string $tipoNovedad,
        public string $descripcionNovedad,
        public int $noDocumentoColaborador,
        public ?int $noDocumentoCliente,
        public ?string $etapaNovedad,
        public ?int $idReserva
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            tipoNovedad: $data['tipo_novedad'],
            descripcionNovedad: $data['descripcion_novedad'],
            noDocumentoColaborador: (int)$data['no_documento_colaborador'],
            noDocumentoCliente: isset($data['no_documento_cliente']) ? (int)$data['no_documento_cliente'] : null,
            etapaNovedad: $data['etapa_novedad'] ?? null,
            idReserva: isset($data['id_reserva']) ? (int)$data['id_reserva'] : null
        );
    }
}

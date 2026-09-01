<?php

namespace App\DTOs;

class StoreReservaDTO
{
    public function __construct(
        public int $noDocumentoCliente,
        public string $placaVehiculo,
        public int $noDocumentoColaborador,
        public string $fecha,
        public string $hora,
        public int $idPlan,
        public int $idServicio,
        public string $etapaLavado,
        public string $fotosVehiculo
    ) {}

    // Este método toma los datos limpios del Request anterior y los transforma en este objeto DTO
    public static function fromRequest(array $data): self
    {
        return new self(
            noDocumentoCliente: (int)$data['no_documento_cliente'],
            placaVehiculo: $data['placa_vehiculo'],
            noDocumentoColaborador: (int)$data['no_documento_colaborador'],
            fecha: $data['fecha'],
            hora: $data['hora'],
            idPlan: (int)$data['id_plan'],
            idServicio: (int)$data['id_servicio'],
            etapaLavado: $data['etapa_lavado'] ?? 'Pendiente',
            fotosVehiculo: $data['fotos_vehiculo']
        );
    }
}

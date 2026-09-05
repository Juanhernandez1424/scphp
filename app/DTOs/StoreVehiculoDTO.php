<?php

namespace App\DTOs;

class StoreVehiculoDTO
{
    public function __construct(
        public string $placaVehiculo,
        public int $noDocumentoCliente,
        public int $idTipoVehiculo,
        public string $colorVehiculo,
        public string $marcaVehiculo,
        public string $modeloVehiculo
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            placaVehiculo: $data['placa_vehiculo'],
            noDocumentoCliente: (int)$data['no_documento_cliente'],
            idTipoVehiculo: (int)$data['id_tipo_vehiculo'],
            colorVehiculo: $data['color_vehiculo'],
            marcaVehiculo: $data['marca_vehiculo'],
            modeloVehiculo: $data['modelo_vehiculo']
        );
    }
}

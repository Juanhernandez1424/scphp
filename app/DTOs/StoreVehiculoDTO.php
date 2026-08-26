<?php

namespace App\DTOs;

class StoreVehiculoDTO
{
    public function __construct(
        public string $numeroPlaca,
        public int $noDocumentoCliente,
        public string $tipoVehiculo,
        public string $colorVehiculo,
        public string $marcaVehiculo,
        public string $modeloVehiculo
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            numeroPlaca: $data['numero_placa'],
            noDocumentoCliente: (int)$data['no_documento_cliente'],
            tipoVehiculo: $data['tipo_vehiculo'],
            colorVehiculo: $data['color_vehiculo'],
            marcaVehiculo: $data['marca_vehiculo'],
            modeloVehiculo: $data['modelo_vehiculo']
        );
    }
}

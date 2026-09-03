<?php

namespace App\DTOs;

class StoreServicioDTO
{
    public function __construct(
        public string $nombreServicio,
        public string $descripcionServicio,
        public string $idTipoVehiculo,
        public float $costoServicio
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            nombreServicio: $data['nombre_servicio'],
            descripcionServicio: $data['descripcion_servicio'],
            idTipoVehiculo: (int)$data['id_tipo_vehiculo'],
            costoServicio: (float)$data['costo_servicio']
        );
    }
}

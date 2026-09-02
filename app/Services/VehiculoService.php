<?php

namespace App\Services;

use App\DTOs\StoreVehiculoDTO;
use App\Models\Vehiculo;
use Exception;
use Illuminate\Support\Facades\DB;

class VehiculoService
{
    public function getAll()
    {
        return Vehiculo::with([
            'usuario'
        ])->get();
    }

    public function getById(string $placaVehiculo): Vehiculo
    {
        return Vehiculo::with([
            'usuario'
        ])->findOrFail($placaVehiculo);
    }

    /**
     * Registra un vehiculo asociado a un cliente.
     * 
     * @param StoreVehiculoDTO $dto
     * @return Vehiculo
     * @throws Exception
     */
    public function registrarVehiculo(StoreVehiculoDTO $dto): Vehiculo
    {
        return DB::transaction(function () use ($dto) {
            $vehiculo = Vehiculo::create([
                'placa_vehiculo' => $dto->placaVehiculo,
                'no_documento_cliente' => $dto->noDocumentoCliente,
                'tipo_vehiculo' => $dto->tipoVehiculo,
                'color_vehiculo' => $dto->colorVehiculo,
                'marca_vehiculo' => $dto->marcaVehiculo,
                'modelo_vehiculo' => $dto->modeloVehiculo,
                'estado_vehiculo' => true
            ]);

            return $vehiculo;
        });
    }
}

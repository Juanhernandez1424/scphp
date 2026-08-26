<?php

namespace App\Services;

use App\DTOs\StoreVehiculoDTO;
use App\Http\Requests\StoreVehiculoRequest;
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


    /**
     * Registra un vehiculo asociado a un cliente.
     * 
     * @param StoreVehiculoDTO $dto
     * @return Vehiculo
     * @throws Exception
     */
    public function registrarVehiculo(StoreVehiculoRequest $dto): Vehiculo
    {
        return DB::transaction(function () use ($dto) {
            $vehiculo = Vehiculo::create([
                'numero_placa' => $dto->numeroPlaca,
                'noDocumentoCliente' => $dto->noDocumentoCliente,
                'tipoVehiculo' => $dto->tipoVehiculo,
                'colorVehiculo' => $dto->colorVehiculo,
                'marcaVehiculo' => $dto->marcaVehiculo,
                'modeloVehiculo' => $dto->modeloVehiculo,
                'estado_vehiculo' => true
            ]);

            return $vehiculo;
        });
    }
}

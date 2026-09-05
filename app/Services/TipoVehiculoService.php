<?php

namespace App\Services;

use App\DTOs\StoreTipoVehiculoDTO;
use App\Http\Requests\StoreTipoVehiculoRequest;
use App\Models\TipoVehiculo;
use Illuminate\Support\Facades\DB;

class TipoVehiculoService
{
    public function getAll()
    {
        return TipoVehiculo::with([
            'servicio'
        ])
            ->orderBy('id_tipo_vehiculo', 'desc')
            ->get();
    }
    public function getById(int $idTipoVehiculo)
    {
        return TipoVehiculo::with([
            'servicio'
        ])
            ->findOrFail($idTipoVehiculo);
    }
    public function registrarTipoVehiculo(StoreTipoVehiculoDTO $dto): TipoVehiculo
    {
        return DB::transaction(function () use ($dto) {
            $tipoVehiculo = TipoVehiculo::create([
                'nombre_tipo_vehiculo' => $dto->nombre_tipo_vehiculo,
                'estado_vehiculo' => true
            ]);
            return $tipoVehiculo;
        });
    }
}

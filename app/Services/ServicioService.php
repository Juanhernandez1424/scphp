<?php

namespace App\Services;

use App\DTOs\StoreServicioDTO;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;

class ServicioService
{
    public function getAll()
    {
        return Servicio::with([
            'tipoVehiculo'
        ])
            ->orderBy('id_servicio', 'desc')
            ->get();
    }

    public function getById(int $idServicio): Servicio
    {
        return Servicio::with([
            'tipoVehiculo'
        ])->findOrFail($idServicio);
    }

    public function getByTipoVehiculo(int $idTipoVehiculo)
    {
        return Servicio::with([
            'tipoVehiculo'
        ])
            ->where('id_tipo_vehiculo', $idTipoVehiculo)
            ->orderBy('nombre_servicio', 'asc')
            ->get();
    }


    public function registrarServicio(StoreServicioDTO $dto): Servicio
    {
        return DB::transaction(function () use ($dto) {
            return Servicio::create([
                'nombre_servicio' => $dto->nombreServicio,
                'descripcion_servicio' => $dto->descripcionServicio,
                'id_tipo_vehiculo' => $dto->idTipoVehiculo,
                'costo_servicio' => $dto->costoServicio
            ]);
        });
    }
    public function actualizarServicio(int $idServicio, StoreServicioDTO $dto): Servicio
{
    return DB::transaction(function () use ($idServicio, $dto) {
        $servicio = Servicio::findOrFail($idServicio);

        $servicio->update([
            'nombre_servicio' => $dto->nombreServicio,
            'descripcion_servicio' => $dto->descripcionServicio,
            'id_tipo_vehiculo' => $dto->idTipoVehiculo,
            'costo_servicio' => $dto->costoServicio
        ]);

        return $servicio->fresh(['tipoVehiculo']);
    });
}

public function eliminarServicio(int $idServicio): bool
{
    $servicio = Servicio::findOrFail($idServicio);
    return $servicio->delete();
}
}

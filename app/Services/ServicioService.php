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
}

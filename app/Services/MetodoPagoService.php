<?php

namespace App\Services;

use App\Models\MetodoPago;

class MetodoPagoService
{
    public function getAll()
    {
        return MetodoPago::orderBy('id_metodo_pago', 'desc')->get();
    }

    public function getById(int $idMetodoPago): MetodoPago
    {
        return MetodoPago::findOrFail($idMetodoPago);
    }
}

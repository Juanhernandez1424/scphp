<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'tipo_vehiculo';

    public $timestamps = false;

    protected $primaryKey = 'id_tipo_vehiculo';

    protected $fillable = [
        'id_tipo_vehiculo',
        'nombre_tipo_vehiculo',
        'estado_tipo_vehiculo',
        'servicio'
    ];

    public function servicio()
    {
        return $this->hasMany(Servicio::class, 'id_tipo_vehiculo', 'id_tipo_vehiculo');
    }
}

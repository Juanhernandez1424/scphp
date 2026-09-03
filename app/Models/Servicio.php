<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicio';

    public $timestamps = false;

    protected $primaryKey = 'id_servicio';

    protected $fillable = [
        'id_servicio',
        'nombre_servicio',
        'id_tipo_vehiculo',
        'descripcion_servicio',
        'costo_servicio'
    ];

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo', 'id_tipo_vehiculo');
    }
}

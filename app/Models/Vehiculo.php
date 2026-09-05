<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculo';

    public $timestamps = false;

    protected $primaryKey = 'numero_placa';

    protected $fillable = [
        'placa_vehiculo',
        'no_documento_cliente',
        'id_tipo_vehiculo',
        'color_vehiculo',
        'marca_vehiculo',
        'modelo_vehiculo'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'no_documento_cliente', 'no_documento_cliente');
    }

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'tipo_vehiculo', 'id_tipo_vehiculo');
    }
}

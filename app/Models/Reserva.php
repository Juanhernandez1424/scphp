<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reserva';

    public $timestamps = false;

    protected $primaryKey = 'id_reserva';

    protected $fillable = [
        'id_reserva',
        'no_documento_cliente',
        'placa_vehiculo',
        'no_documento_colaborador',
        'fecha',
        'hora',
        'id_plan',
        'id_servicio',
        'etapa_lavado',
        'fotos_vehiculo',
        'estado_reserva'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'no_documento_cliente', 'no_documento_cliente');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'placa_vehiculo', 'placa_vehiculo');
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'no_documento_colaborador', 'no_documento_colaborador');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan', 'id_plan');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id_servicio');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    use HasFactory;

    protected $table = 'novedades';

    public $timestamps = false;

    protected $primaryKey = 'id_novedad';

    protected $fillable = [
        'tipo_novedad',
        'descripcion_novedad',
        'ticket_novedad',
        'no_documento_colaborador',
        'no_documento_cliente',
        'etapo_novedad',
        'id_reserva'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'no_documento_cliente', 'no_documento_cliente');
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'no_documento_colaborador', 'no_documento_colaborador');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobantePago extends Model
{
    use HasFactory;

    protected $table = 'comprobante_pago';

    public $timestamps = false;

    protected $primaryKey = 'id_comprobante_pago';

    protected $fillable = [
        'id_comprobante_pago',
        'id_reserva',
        'id_metodo_pago',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago', 'id_metodo_pago');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plan';

    public $timestamps = false;

    protected $primaryKey = 'id_plan';
    
    protected $fillable = ['nombre_plan', 'descripcion_plan', 'cantidad_servicios', 'costo_plan', 'id_metodo_pago', 'estado_plan'];
}

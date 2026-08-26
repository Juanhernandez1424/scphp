<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    protected $table = 'telefono';

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'id_usuario',
        'numero_celular'
    ];
}

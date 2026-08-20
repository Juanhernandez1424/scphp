<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    public $timestamps = false;

    protected $primaryKey = 'id_usuario';

    public function correo()
    {
        return $this->hasOne(Correo::class, 'id_usuario', 'id_usuario');
    }

    public function telefono()
    {
        return $this->hasOne(Telefono::class, 'id_usuario', 'id_usuario');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_usuario', 'id_usuario');
    }

    public function colaborador()
    {
        return $this->hasOne(Colaborador::class, 'id_usuario', 'id_usuario');
    }

    public function coordinador()
    {
        return $this->hasOne(Coordinador::class, 'id_usuario', 'id_usuario');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'id_usuario', 'id_usuario');
    }
}

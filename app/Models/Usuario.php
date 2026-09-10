<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';

    public $timestamps = false;

    protected $primaryKey = 'id_usuario';

    public function getAuthPasswordName()
    {
        return 'contrasenia';
    }

    public function getAuthPassword()
    {
        return $this->contrasenia;
    }

    protected $fillable = [
        'id_usuario',
        'tipo_documento',
        'nombre_usuario',
        'apellido_usuario',
        'numero_celular',
        'id_rol',
        'contrasenia',
        'estado_usuario'
    ];
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

    public function vehiculo()
    {
        return $this->hasManyThrough(
            Vehiculo::class,
            Cliente::class,
            'id_usuario',
            'no_documento_cliente',
            'id_usuario',
            'no_documento_cliente'
        );
    }
}

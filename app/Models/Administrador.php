<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administrador';

    public $timestamps = false;

    protected $primaryKey = 'no_documento_administrador';

    protected $fillable = ['no_documento_administrador', 'id_usuario'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}

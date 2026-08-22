<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    public $timestamps = false;

    protected $primaryKey = 'no_documento_cliente';

    protected $fillable = ['no_documento_cliente', 'id_usuario'];
}

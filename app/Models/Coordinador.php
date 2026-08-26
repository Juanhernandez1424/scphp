<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    use HasFactory;

    protected $table = 'coordinador';

    public $timestamps = false;

    protected $primaryKey = 'no_documento_coordinador';

    protected $fillable = ['no_documento_coordinador', 'id_usuario'];
}

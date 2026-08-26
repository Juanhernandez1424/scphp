<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaborador';

    public $timestamps = false;

    protected $primaryKey = 'no_documento_colaborador';

    protected $fillable = ['no_documento_colaborador', 'id_usuario'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    protected $table = 'correo';

    public $timestamps = false;

    use HasFactory;
}

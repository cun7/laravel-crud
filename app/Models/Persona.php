<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'personas';

    //Campos para insertar datos
    protected $fillable = ['nombre', 'edad', 'foto'];
}

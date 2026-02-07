<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    //Activar Soft Deletes. softDeletes() habilita papelera
    use SoftDeletes;
    //
    protected $table = 'personas';

    //Campos para insertar datos
    protected $fillable = ['nombre', 'edad', 'foto'];

}

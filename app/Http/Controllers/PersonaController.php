<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //
    public function index(){
        return view('personas');
    }

    public function guardar(Request $request){
        $nombre = $request->nombre;
        $edad = $request->edad;

        return "Nombre: $nombre - Edad: $edad";
    }
}

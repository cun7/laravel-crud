<?php

namespace App\Http\Controllers;

//Importamos el modelo
use App\Models\Persona;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //Muestra el formulario
    public function create(){
        //Retorna la vista del formulario
        return view('personas.create');
    }

    //Guarda los datos a la BD
    public function store(Request $request) {

        //Validación básica
        $request->validate([
            'nombre' => 'required',
            'edad'   => 'required|integer'
        ]);

        //Inserta los datos en la tabla personas
        Persona::create([
            'nombre' => $request->nombre,
            'edad' => $request->edad
        ]);

        //Redirige al listado
        //return redirect('/personas');
        return redirect()->route('personas.index');
    }

    //Lista la personas
    public function index()
    {   
        //Obtiene todos los registros
        $personas = Persona::all();

        //Envia los datos a la vista
        return view('personas.index', compact('personas'));
    }

/*
    public function guardar(Request $request)
    {
        $nombre = $request->nombre;
        $edad = $request->edad;

        return "Nombre: $nombre - Edad: $edad";
    }
*/


}

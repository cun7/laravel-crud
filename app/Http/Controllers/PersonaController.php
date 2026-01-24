<?php

namespace App\Http\Controllers;

//Importamos el modelo
use App\Models\Persona;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //Muestra el formulario cear
    public function create(){
        //Retorna la vista del formulario
        return view('personas.create');
    }

    //Guarda los datos a la BD
    public function store(Request $request) {

        //Validación básica
        $request->validate([
            'nombre' => 'required|min:3',
            'edad'   => 'required|integer|min:1'
        ]);

        //Inserta los datos en la tabla personas
        Persona::create([
            'nombre' => $request->nombre,
            'edad' => $request->edad
        ]);

        //Persona::create($request->all);//INSERT

        //Redirige al listado
        //return redirect('/personas');
        return redirect()->route('personas.index')->with('success', 'Persona registrada correctamente');//Mensaje flash (vive solo una petición)
    }

    //Mostrar formulario  de edición
    public function edit($id){
        //Busca la persona por ID
        $persona = Persona::findOrFail($id);

        //Envía la persona encontrada a la vista
        return view('personas.edit', compact('persona'));
    }

    //Actualizar datos en la base de datos
    public function update(Request $request, $id){
        //Validar campos que no esten vacíos
        $request->validate([
            'nombre' => 'required|min:3',
            'edad'   => 'required|integer:min:1'
        ]);

        $persona = Persona::findOrFail($id);

        //UPDATE persona SET 
        $persona->update($request->all());
        
        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente');
    }

    //Eliminar
    public function destroy($id){
        $persona = Persona::FindOrFail($id);
        //DELETE FROM personas
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente');
    }

    //Lista la personas
    public function index(Request $request)
    {   
        //Campo por el cual ordenar
        $orderBy = $request->get('order_by', 'id');

        //Dirección del orden
        $direction = $request->get('direction', 'asc');

        //Consulta con orden dinámico
        $personas = Persona::orderBy($orderBy, $direction)->simplePaginate(5)->appends($request->all());

        //Obtiene 5 personas por página
        //$personas = Persona::orderBy('id','desc')->paginate(10);
      
        //Obtiene todos los registros
        //SELECT / FROM personas
        //$personas = Persona::all();

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

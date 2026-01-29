<?php

namespace App\Http\Controllers;

//Importamos el modelo
use App\Models\Persona;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
        //Lista la personas
        public function index(Request $request)
        {   
            //Campo por el cual ordenar
            $orderBy = $request->get('order_by', 'id');
    
            //Dirección del orden
            $direction = $request->get('direction', 'asc');
    
            //Consulta con orden dinámico
            $personas = Persona::orderBy($orderBy, $direction)->Paginate(5)->appends($request->all());
    
            //Obtenemos las personas ordenadas por nombre (A -> Z)
            //Obtiene 5 personas por página
            //$personas = Persona::orderBy('id','desc')->paginate(10);
          
            //Obtiene todos los registros
            //SELECT / FROM personas
            //$personas = Persona::all();
    
            //Envia los datos a la vista
            return view('personas.index', compact('personas'));
        }


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
        //Valida los datos enviados desde el formulario
        $request->validate([
            'nombre' => 'required|min:3',
            'edad'   => 'required|integer:min:1'
        ]);

        $persona = Persona::findOrFail($id);

        //UPDATE persona SET 
        //Guarda los cambios en la base de datos
        $persona->update($request->all());

        //Actualizamos los datos
       /* $persona->update([
            'nombre' => $request->nombre,
            'edad'   => $request->edad

        ]);
        */
        //Mensaje flash (vive solo unapetición)
        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente');
    }

    //Eliminar
    public function destroy($id){
         //Solo admin puede eliminar
         //if(!Auth::user()->isAdmin()){
            //abort(403);
        //}

        $user = Auth::user();
        if(!$user || !$user->isAdmin()){
            abort(403);
        }

        $persona = Persona::FindOrFail($id);
        //DELETE FROM personas
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente');
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

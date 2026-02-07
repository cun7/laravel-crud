<?php

namespace App\Http\Controllers;

//Importamos el modelo
use App\Models\Persona;
//use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
        //Lista la personas
        public function index(Request $request)
        {   
            $query = Persona::query();
            //Buscar por nombre
            if($request->filled('txtBuscar')){
                $query->where('nombre', 'like', '%' . $request->txtBuscar . '%');
            }

            //Paginación por búsqueda
            $personas = $query->orderBy('id', 'desc')->paginate(5);

            //Campo por el cual ordenar
            $orderBy = $request->get('order_by', 'id');
    
            //Dirección del orden
            $direction = $request->get('direction', 'asc');
    
            //Consulta con orden dinámico
            //$personas = Persona::orderBy($orderBy, $direction)->Paginate(5)->appends($request->all());
    
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
            'txtEdad'   => 'required|integer|min:1',
            'txtFoto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
       
        $nombreArchivo= null;

        //Verificar si el formulario envió un archivo foto
        if($request->hasFile('txtFoto')){
            //Crear el nombre del archivo y obtener la extensión
            $nombreArchivo = time() . '.' .$request->txtFoto->extension();
            //Mover el archivo foto desde el formulario hasta la carpeta fotos
            $request->txtFoto->move(public_path('fotos'), $nombreArchivo);
            //$persona->foto = $nombreArchivo;
        }

       /* if (!file_exists(public_path('fotos'))) {
            mkdir(public_path('fotos'), 0777, true);
        }
       */
        
        //Inserta los datos en la tabla personas
        Persona::create([
            'nombre' => $request->nombre,
            'edad'   => $request->txtEdad,
            'foto'   => $nombreArchivo
            //Verificar si esta recibiendo el nombre de la foto
             //dd($nombreArchivo)
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

        //Solo admin puede eliminar
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if(!$user->isAdmin()){
            abort(403);
        }

        //Solo admin puede eliminar
        /*$user = Auth::user();
        if(!$user || !$user->isAdmin()){
            abort(403);
        }*/

        $persona = Persona::FindOrFail($id);
        //DELETE FROM personas
        $persona->delete();

        //Eliminar foto
        if($persona->foto && file_exists(public_path('fotos/' . $persona->foto))){
            unlink(public_path('fotos/' . $persona->foto));
        }
        

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente');
    }

    //Listar las personas que estan en la papelera
    public function papelera(){
        //onlyTrashed() lista solo eliminados
        $personas = Persona::onlyTrashed()->paginate(5);
        return view('personas.papelera', compact('personas'));
        //dd($personas);

        //withTrashed() Todos(activos + papelera)
    }

    //Restaurar las personas de la papelera
    public function restaurar($id){
        //Restore() recupera
        Persona::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('personas.papelera')->with('success','Persona restaurada correctamente');
    }

    //Eliminar definitivamente
    public function eliminarDefinitivo($id){
        $persona = Persona::onlyTrashed()->findOrFail($id);
        
        //Eliminar foto si existe
        if($persona->foto && file_exists(public_path('fotos/' . $persona->foto))){
            unlink(public_path('fotos/' . $persona->foto));
        }

        //forceDelete() Borra definitivamente
        $persona->forceDelete();
       
        return redirect()->route('personas.papelera')->with('success','Persona eliminada definitivamente');
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

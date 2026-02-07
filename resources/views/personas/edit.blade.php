<h1>Formulario Editar Persona</h1>

{{--Mostrar errores--}}
@if($errors->any())
    <div  style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('personas.actualizar', $persona->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    @method('PUT') {{--Simula PUT--}}

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="{{ $persona->nombre }}"><br><br>

    <label>Edad:</label><br>
    <input type="number" name="edad" value="{{ $persona->edad }}"><br><br>

    <label>Foto</label><br>
    <input type="file" name="txtFoto" value="{{ $persona->foto }}"><br><br>

<button type="submit">Actualizar</button>
</form>
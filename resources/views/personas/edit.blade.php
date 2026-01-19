<h1>Formulario Editar Personaa</h1>

<form action="{{ route('personas.actualizar', $persona->id) }}" method="POST">
    @csrf

    @method('PUT') {{--Simula PUT--}}

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="{{ $persona->nombre }}"><br><br>

    <label>Edad:</label><br>
    <input type="number" name="edad" value="{{ $persona->edad }}"><br><br>

<button type="submit">Actualizar</button>
</form>
<h1>Registrar persona</h1>

{{--Formulario que envía datos por POST--}}
<form action="{{route('personas.guardar')}}" method="POST">
    {{--Protección contra ataques CSRF--}}
    @csrf

    {{--Campo nombre--}}
    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br><br>

    {{--Campo edad--}}
    <label>Edad:</label><br>
    <input type="number" name="edad"><br><br>

    <button type="submit">Guardar</button>
</form>
<h1>Registrar persona</h1>

{{--Mostrar errores--}}
@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--Formulario que envía datos por POST--}}
<form action="{{route('personas.guardar')}}" method="POST" enctype="multipart/form-data">
    {{--Protección contra ataques CSRF--}}
    @csrf

    {{--Campo nombre--}}
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="{{ old('nombre') }}"><br><br>

    {{--Campo edad--}}
    <label>Edad:</label><br>
    <input type="number" name="txtEdad" value="{{ old('edad') }}"><br><br>

    {{-- Campo foto --}}
    <label>Foto</label><br>
    <input type="file" name="txtFoto"><br><br>

    <button type="submit">Guardar</button>
</form>
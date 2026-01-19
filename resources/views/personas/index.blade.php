<h1>Lista de Personas</h1>

{{--Botón para ir al formualrio--}}
<a href="{{route('personas.create')}}">Nueva persona</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Acciones</th>
    </tr>

    {{--Recorremos todas las personas--}}
    @foreach($personas as $persona)
    <tr>
        <td>{{ $persona->id }}</td>
        <td>{{ $persona->nombre }}</td>
        <td>{{ $persona->edad }}</td>
        <td>
            {{--Botón editar--}}
            <a href="{{ route('personas.edit', $persona->id) }}">Editar</a>

            {{--Fromulario eliminar--}}
            <form action="{{ route('personas.eliminar', $persona->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>

        </td>
    </tr>
    @endforeach
</table>
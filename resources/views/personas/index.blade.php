<h1>Lista de Personas</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Edad</th>
    </tr>

    @foreach($personas as $persona)
    <tr>
        <td>{{ $persona->id }}</td>
        <td>{{ $persona->nombre }}</td>
        <td>{{ $persona->edad }}</td>
    </tr>
    @endforeach
</table>

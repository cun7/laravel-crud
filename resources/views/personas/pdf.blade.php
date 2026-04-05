<p>Fecha: {{ now() }}</p>

<h1>Reporte de personas</h1>

<table border="1" width="100%" Style="border-collapse: collapse; background: #eee;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Edad</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($personas as $persona)
        <tr>
            <td>{{ $persona->id }}</td>
            <td>{{ $persona->nombre }}</td>
            <td>{{ $persona->edad}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h1>Papelera de personas</h1>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Foto</th>
        <th>Acciones</th>
    </tr>
    @forelse($personas as $persona)
    <tr>
        <td>{{ $persona->nombre }}</td>
        <td>{{ $persona->edad }}</td>
        <td>{{ $persona->foto }}</td>
        <td>
            {{-- Restaurar persona  de la papelera --}}
            <form action="{{ route('personas.restaurar', $persona->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <button>Restaurar</button>
            </form>
            
            {{-- Eliminar definitivamente a la persona de la papelera --}}
            <form action="{{ route('personas/eliminar', $persona->id) }}" method="POST" style="display: inline"
                onsubmit = "return confirm('¿Seguro que desea eliminar definitivamente a esta persona?')">
                @csrf
                @method('DELETE')
                <button>Eliminar definitivamente</button>
            </form> 
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3">La papelera esta vacía</td>
    </tr>
    @endforelse
</table>

{{-- Mensaje --}}
@if(session('success'))
    <div>
        <p style="background-color: green; color: white; padding: 2px 0px 2px 10px; border-radius: 10px; width: 22%">
            {{ session('success') }}
        </p>
    </div>
@endif

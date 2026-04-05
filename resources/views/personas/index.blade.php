<h1>Lista de Personas</h1>

{{--Mensaje de éxito--}}
@if(session('success'))
<p style="color: green;">
    {{ session('success')}}
</p>
@endif

<style>
    .pagination {
        list-style: none;
        display: flex;
        gap: 5px;
    }

    .pagination li {
        border: 1px solid #ccc;
        padding: 5px 10px;
    }
</style>

{{--Botón para ir al formualrio--}}
<a href="{{route('personas.create')}}">Nueva persona</a>

{{-- Buscar personas por nombre --}}
<form method="GET" action="{{ route('personas.index') }}">
    <input type="text" id="idBuscar" name="txtBuscar" placeholder="Buscar por nombre" value="{{ request('txtBuscar') }}">
    <button>Buscar</button>
</form>

{{-- Formualrio de búsqueda 
    <form method="GET" action="{{ route('personas.index') }}">
        <input type="text" name="txtBuscar" placeholder="Buscar por nombre..." value="{{ $buscar }}">
        <button>Buscar</button>
    </form>
--}}

{{-- Ruta para descargar PDF --}}
<a href="{{ route('personas.pdf') }}">Descargar PDF</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Foto</th>
        <th>Acciones</th>
    </tr>

    {{--Recorremos todas las personas--}}
    @foreach($personas as $persona)
    <tr>
        <td>{{ $persona->id }}</td>
        <td>{{ $persona->nombre }}</td>
        <td>{{ $persona->edad }}</td>
        <td>
            @if($persona->foto)
                <img src="{{ asset('fotos/'. $persona->foto) }}" width="60">
            @endif
        </td>
        <td>
            {{--Botón editar--}}
            <a href="{{ route('personas.edit', $persona->id) }}">Editar</a>

            {{--Fromulario eliminar--}}
            {{-- Ocultar botón, solo el admin puede verlo --}}
            @if(Auth::user()->isAdmin())
            <form action="{{ route('personas.eliminar', $persona->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Seguro que desea elimimar esta persona?')">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
            @endif

        </td>
    </tr>
    @endforeach
</table>

@if($personas->isEmpty())
    <p>No se encontraron resultados.</p>
@endif

<div id="idResultados"></div>


<a href="?order_by=nombre&direction=asc">Nombre ↑</a> |
<a href="?order_by=nombre&direction=desc">Nombre ↓</a> |
<a href="?order_by=edad&direction=asc">Edad ↑</a> |
<a href="?order_by=edad&direction=desc">Edad ↓</a>

{{--Links de paginación--}}
{{ $personas->links() }}

{{-- Crear paginación manual --}}
@if($personas->hasPages())
<div style="margin-top:10px;">
    {{-- Botón anterior --}}
    @if($personas->onfirstPage())
    <span>Anterior</span>
    @else
    <a href="{{ $personas->previousPageUrl() }}">Anterior</a>
    @endif

    |

    {{-- Botón siguiente --}}
    @if($personas->hasMorePages())
    <a href="{{ $personas->nextPageUrl() }}">Siguiente</a>
    @else
    <span>Siguiente</span>
    @endif
</div>

@endif()

{{-- Paginación pro --}}
{{-- $personas->appends(request()->query())->links() --}}

<script>
    //Obtener el input
    const input = document.getElementById('idBuscar');

    //Contenedor donde mostraremos resultados
    const resultados = document.getElementById('idResultados');

    //Escuchar cuando el usuario escribe
    input.addEventListener('keyup', function(){
        //Obtener lo que escribe
        let texto = this.value;

        //Hacer petición AJAX a Laravel
        fetch(`/buscar-personas?buscar=${texto}`)
            .then(response =>response.json()) //convertir a JSON
            .then(data => {
                //Limpiar resultdos anteriores
                resultados.innerHTML="";

                //Recorrer resultados
                data.forEach(persona => {
                    //Crear HTML dinámico
                    let item = `
                        <p>${persona.nombre} - ${persona.edad}</p>
                    `;

                    //Insertar en el div
                    resultados.innerHTML += item;
                });

                //Si no hay resultados
                if(data.length === 0){
                    resultados.innerHTML = "<p>No hay resultados</p>";
                }
                
            });
        
    });

//Para que no haga muchas peticiones
let timeout;

input.addEventListener('keyup', function(){
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        let texto = this.value;

        fetch(`/buscar-personas?buscar=${texto}`)
        .then(res => res.json())
        .then(data => {
            resultados.innerHTML = "";

            data.forEach(p => {
                resultados.innerHTML += `<p>${p.nombre} - ${p.edad}</p>`;
            });
        });
    }, 300); //Espera 300ms
});

</script>
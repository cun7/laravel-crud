<h1>Dashboard</h1>
{{-- Total de personas --}}
<p>Total: {{ $total }}</p>

{{-- Personas activas--}}
<p>Activos: {{ $activos }}</p>

{{-- Person as en papelera --}}
<p>Eliminados: {{ $eliminadoss }}</p>

<hr>

<h3>Últimas personas registradas</h3>
<ul>
    @foreach($ultimas as $persona)
    <li>
        {{-- Mostrar nombre y edad --}}
        {{ $persona->nombre}} - {{ $persona->edad}}
    </li>
    @endforeach
</ul>

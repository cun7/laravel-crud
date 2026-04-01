<h1>Dashboard</h1>
{{-- Total de personas --}}
<p>Total: {{ $total }}</p>

{{-- Personas activas--}}
<p>Activos: {{ $activos }}</p>

{{-- Personas en papelera --}}
<p>Eliminados: {{ $eliminadoss }}</p>

<hr>

<h3>Gráfica de personas registradas</h3>

{{-- Canvas donde se dibuja la gráfica --}}
<canvas id="miGrafica" width="1000" height="200"></canvas>

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


{{-- Importamos Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    //Recibimos datos de Laravel (PHP -> JS)
   const datos = @json($datosGrafica);
   //const datos = {!! json_encode($datosGrafica) !! };
   //const datos = JSON.parse('{!! json_encode($datosGrafica) !! }');

    //Obtener el canvas
    const ctx = document.getElementById('miGrafica').getContext('2d');

    //Crear gráfica
    new Chart(ctx, {
        //Tipo: barra
        type: 'bar',
        data:{
            //Nombres
            labels: ['Activos', 'Eliminadoos'],
            datasets:[{
                label: 'Personass',
                //Valores
                data: [datos.activos, datos.eliminados],
                //Colores
                backgroundColor:[
                    'green',
                    'red'
                ]
            }]
        },

        options: {
            responsive: true
        }
    });
</script>

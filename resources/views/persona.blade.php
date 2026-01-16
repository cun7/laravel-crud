<h2>Formulario Personas</h2>

<form method="POST" action="/guardar">
    @csrf
    
    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br><br>

    <label>Edad:</label><br>
    <input type="number" name="edad"><br><br>

    <button type="submit">Guardar</button>
</form>


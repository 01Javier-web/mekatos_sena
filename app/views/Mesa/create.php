<form action="" method="POST">

    <h2>Crear Mesa</h2>

    <div>
        <label for="numero">Número de mesa:</label>
        <input
            type="number"
            id="numero"
            name="numero"
            min="1"
            required
        >
    </div>

    <div>
        <label for="capacidad">Capacidad:</label>
        <input
            type="number"
            id="capacidad"
            name="capacidad"
            min="1"
            required
        >
    </div>

    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="Disponible">Disponible</option>
            <option value="Ocupada">Ocupada</option>
            <option value="Reservada">Reservada</option>
            <option value="Fuera de servicio">Fuera de servicio</option>
        </select>
    </div>

    <div>
        <button type="submit">Guardar Mesa</button>
    </div>

</form>
<form action="" method="POST">

    <h2>Crear Categoría</h2>

    <div>
        <label for="nombre">Nombre:</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            maxlength="100"
            required
        >
    </div>

    <div>
        <label for="descripcion">Descripción:</label>
        <textarea
            id="descripcion"
            name="descripcion"
            maxlength="255"
        ></textarea>
    </div>

    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select>
    </div>

    <div>
        <button type="submit">Guardar Categoría</button>
    </div>

</form>
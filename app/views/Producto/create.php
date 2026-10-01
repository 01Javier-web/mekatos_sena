<form action="" method="POST">

    <h2>Crear Producto</h2>

    <div>
        <label for="id_categoria">ID de categoría:</label>
        <input
            type="number"
            id="id_categoria"
            name="id_categoria"
            min="1"
            required
        >
    </div>

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
        <label for="precio">Precio:</label>
        <input
            type="number"
            id="precio"
            name="precio"
            step="0.01"
            min="0"
            required
        >
    </div>

    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="Disponible">Disponible</option>
            <option value="No disponible">No disponible</option>
        </select>
    </div>

    <div>
        <button type="submit">Guardar Producto</button>
    </div>

</form>
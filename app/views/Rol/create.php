<form action="" method="POST">

    <h2>Crear Rol</h2>

    <div>
        <label for="nombre">Nombre:</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            maxlength="50"
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
        <button type="submit">Guardar Rol</button>
    </div>

</form>
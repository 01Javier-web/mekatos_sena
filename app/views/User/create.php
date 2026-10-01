<form action="" method="POST">

    <h2>Crear Usuario</h2>

    <div>
        <label for="id_rol">ID de rol:</label>
        <input
            type="number"
            id="id_rol"
            name="id_rol"
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
        <label for="apellido">Apellido:</label>
        <input
            type="text"
            id="apellido"
            name="apellido"
            maxlength="100"
        >
    </div>

    <div>
        <label for="correo">Correo:</label>
        <input
            type="email"
            id="correo"
            name="correo"
            maxlength="150"
            required
        >
    </div>

    <div>
        <label for="telefono">Teléfono:</label>
        <input
            type="text"
            id="telefono"
            name="telefono"
            maxlength="20"
        >
    </div>

    <div>
        <label for="password">Contraseña:</label>
        <input
            type="password"
            id="password"
            name="password"
            maxlength="255"
            required
        >
    </div>

    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select>
    </div>

    <div>
        <button type="submit">Guardar Usuario</button>
    </div>

</form>
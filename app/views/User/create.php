<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>

<body>

    <h1>Crear Usuario</h1>

    <form method="POST" action="?controller=user&action=guardar">

        <label>ID Rol:</label>
        <input type="number" name="id_rol" required>

        <br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <br><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" required>

        <br><br>

        <label>Correo:</label>
        <input type="email" name="correo" required>

        <br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono">

        <br><br>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <br><br>

        <label>Estado:</label>

        <select name="estado">

            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=user&action=index">
        Ver usuarios
    </a>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Rol</title>
</head>

<body>

    <h1>Crear Rol</h1>

    <form method="POST" action="?controller=rol&action=guardar">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <br><br>

        <label>Descripción:</label>
        <input type="text" name="descripcion">

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=rol&action=index">
        Ver roles
    </a>

</body>

</html>
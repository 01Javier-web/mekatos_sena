<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Mesa</title>
</head>

<body>

    <h1>Crear Mesa</h1>

    <form method="POST" action="?controller=mesa&action=guardar">

        <label>Número:</label>
        <input type="number" name="numero" required>

        <br><br>

        <label>Capacidad:</label>
        <input type="number" name="capacidad" required>

        <br><br>

        <label>Estado:</label>

        <select name="estado">

            <option value="Disponible">Disponible</option>
            <option value="Ocupada">Ocupada</option>
            <option value="Reservada">Reservada</option>
            <option value="Fuera de servicio">Fuera de servicio</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=mesa&action=index">
        Ver mesas
    </a>

</body>

</html>
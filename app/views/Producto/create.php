<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>

<body>

    <h1>Crear Producto</h1>

    <form method="POST" action="?controller=producto&action=guardar">

        <label>ID Categoría:</label>
        <input type="number" name="id_categoria" required>

        <br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <br><br>

        <label>Descripción:</label>
        <input type="text" name="descripcion">

        <br><br>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" required>

        <br><br>

        <label>Estado:</label>

        <select name="estado">

            <option value="Disponible">Disponible</option>
            <option value="No disponible">No disponible</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=producto&action=index">
        Ver productos
    </a>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Categoría</title>
</head>

<body>

    <h1>Crear Categoría</h1>

    <form method="POST" action="?controller=categoria&action=guardar">

        <div>
            <label for="nombre">Nombre:</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                required
            >
        </div>

        <br>

        <div>
            <label for="descripcion">Descripción:</label>
            <input
                type="text"
                id="descripcion"
                name="descripcion"
            >
        </div>

        <br>

        <div>
            <label for="estado">Estado:</label>

            <select id="estado" name="estado">

                <option value="Activo">
                    Activo
                </option>

                <option value="Inactivo">
                    Inactivo
                </option>

            </select>
        </div>

        <br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=categoria&action=index">
        Ver categorías
    </a>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear producto</title>
</head>

<body>

    <h1>Crear producto</h1>

    <form method="POST" action="?controller=producto&action=guardar">

        <label for="id_categoria">Categoría:</label>

        <select name="id_categoria" id="id_categoria" required>
            <option value="">Selecciona una categoría</option>

            <?php foreach (($categorias ?? []) as $categoria): ?>

                <option value="<?= htmlspecialchars((string) ($categoria['id_categoria'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars((string) ($categoria['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="nombre">Nombre:</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            required
        >

        <br><br>

        <label for="descripcion">Descripción:</label>

        <input
            type="text"
            id="descripcion"
            name="descripcion"
        >

        <br><br>

        <label for="precio">Precio:</label>

        <input
            type="number"
            id="precio"
            name="precio"
            step="0.01"
            min="0"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="No disponible">No disponible</option>
        </select>

        <br><br>

        <button type="submit">Guardar producto</button>

        <a href="?controller=producto&action=index">Cancelar</a>

    </form>

</body>

</html>

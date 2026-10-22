
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
</head>

<body>

    <h1>Editar producto</h1>

    <form method="POST" action="?controller=producto&action=update">

        <input
            type="hidden"
            name="id_producto"
            value="<?= htmlspecialchars((string) ($producto['id_producto'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="id_categoria">Categoría:</label>

        <select name="id_categoria" id="id_categoria" required>
            <option value="">Selecciona una categoría</option>

            <?php foreach (($categorias ?? []) as $categoria): ?>
                <option
                    value="<?= htmlspecialchars((string) ($categoria['id_categoria'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                    <?= (string) ($categoria['id_categoria'] ?? '') === (string) ($producto['id_categoria'] ?? '') ? 'selected' : '' ?>
                >
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
            value="<?= htmlspecialchars((string) ($producto['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="descripcion">Descripción:</label>

        <input
            type="text"
            id="descripcion"
            name="descripcion"
            value="<?= htmlspecialchars((string) ($producto['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label for="precio">Precio:</label>

        <input
            type="number"
            id="precio"
            name="precio"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars((string) ($producto['precio'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>
            <option
                value="Disponible"
                <?= ($producto['estado'] ?? '') === 'Disponible' ? 'selected' : '' ?>
            >
                Disponible
            </option>

            <option
                value="No disponible"
                <?= ($producto['estado'] ?? '') === 'No disponible' ? 'selected' : '' ?>
            >
                No disponible
            </option>
        </select>

        <br><br>

        <button type="submit">Guardar cambios</button>

        <a href="?controller=producto&action=index">Cancelar</a>

    </form>

</body>

</html>

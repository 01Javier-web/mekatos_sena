
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoría</title>
</head>

<body>

    <h1>Editar categoría</h1>

    <form method="POST" action="?controller=categoria&action=update">

        <input
            type="hidden"
            name="id_categoria"
            value="<?= htmlspecialchars((string) ($categoria['id_categoria'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="nombre">Nombre:</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?= htmlspecialchars((string) ($categoria['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="descripcion">Descripción:</label>

        <textarea
            id="descripcion"
            name="descripcion"
        ><?= htmlspecialchars((string) ($categoria['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <option
                value="Activo"
                <?= ($categoria['estado'] ?? '') === 'Activo' ? 'selected' : '' ?>
            >
                Activo
            </option>

            <option
                value="Inactivo"
                <?= ($categoria['estado'] ?? '') === 'Inactivo' ? 'selected' : '' ?>
            >
                Inactivo
            </option>

        </select>

        <br><br>

        <button type="submit">Guardar cambios</button>

        <a href="?controller=categoria&action=index">Cancelar</a>

    </form>

</body>

</html>

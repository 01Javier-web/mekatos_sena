
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar rol</title>
</head>

<body>

    <h1>Editar rol</h1>

    <form method="POST" action="?controller=rol&action=actualizar">

        <input
            type="hidden"
            name="id_rol"
            value="<?= htmlspecialchars((string) ($rol['id_rol'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="nombre">Nombre del rol:</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?= htmlspecialchars((string) ($rol['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="descripcion">Descripción:</label>

        <textarea
            id="descripcion"
            name="descripcion"
        ><?= htmlspecialchars((string) ($rol['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>

        <br><br>

        <button type="submit">
            Guardar cambios
        </button>

        <a href="?controller=rol&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>

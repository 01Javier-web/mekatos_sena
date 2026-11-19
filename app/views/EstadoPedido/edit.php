
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar estado del pedido</title>
</head>

<body>

    <h1>Editar estado del pedido</h1>

    <form method="POST" action="?controller=estado_pedido&action=actualizar">

        <input
            type="hidden"
            name="id_estado"
            value="<?= htmlspecialchars((string) ($estado['id_estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="nombre">Nombre del estado:</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?= htmlspecialchars((string) ($estado['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <button type="submit">
            Guardar cambios
        </button>

        <a href="?controller=estado_pedido&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>

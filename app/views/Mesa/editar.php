
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar mesa</title>
</head>

<body>

    <h1>Editar mesa</h1>

    <form method="POST" action="?controller=mesa&action=actualizar">

        <input
            type="hidden"
            name="id_mesa"
            value="<?= htmlspecialchars((string) ($mesa['id_mesa'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="numero">Número de mesa:</label>

        <input
            type="number"
            id="numero"
            name="numero"
            value="<?= htmlspecialchars((string) ($mesa['numero'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="capacidad">Capacidad:</label>

        <input
            type="number"
            id="capacidad"
            name="capacidad"
            min="1"
            step="1"
            value="<?= htmlspecialchars((string) ($mesa['capacidad'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <option
                value="Disponible"
                <?= ($mesa['estado'] ?? '') === 'Disponible' ? 'selected' : '' ?>
            >
                Disponible
            </option>

            <option
                value="Ocupada"
                <?= ($mesa['estado'] ?? '') === 'Ocupada' ? 'selected' : '' ?>
            >
                Ocupada
            </option>

            <option
                value="Reservada"
                <?= ($mesa['estado'] ?? '') === 'Reservada' ? 'selected' : '' ?>
            >
                Reservada
            </option>

            <option
                value="Fuera de servicio"
                <?= ($mesa['estado'] ?? '') === 'Fuera de servicio' ? 'selected' : '' ?>
            >
                Fuera de servicio
            </option>

        </select>

        <br><br>

        <button type="submit">
            Guardar cambios
        </button>

        <a href="?controller=mesa&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
</head>

<body>

    <h1>Editar usuario</h1>

    <form method="POST" action="?controller=user&action=actualizar">

        <input
            type="hidden"
            name="id_usuario"
            value="<?= htmlspecialchars((string) ($usuario['id_usuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="id_rol">Rol:</label>

        <select name="id_rol" id="id_rol" required>

            <option value="">Selecciona un rol</option>

            <?php foreach ($roles ?? [] as $rol): ?>

                <option
                    value="<?= htmlspecialchars((string) ($rol['id_rol'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                    <?= (string) ($rol['id_rol'] ?? '') === (string) ($usuario['id_rol'] ?? '') ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars((string) ($rol['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="nombre">Nombre:</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?= htmlspecialchars((string) ($usuario['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="apellido">Apellido:</label>

        <input
            type="text"
            id="apellido"
            name="apellido"
            value="<?= htmlspecialchars((string) ($usuario['apellido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="correo">Correo electrónico:</label>

        <input
            type="email"
            id="correo"
            name="correo"
            value="<?= htmlspecialchars((string) ($usuario['correo'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="telefono">Teléfono:</label>

        <input
            type="text"
            id="telefono"
            name="telefono"
            value="<?= htmlspecialchars((string) ($usuario['telefono'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label for="password">Nueva contraseña:</label>

        <input
            type="password"
            id="password"
            name="password"
            autocomplete="new-password"
        >

        <p>Deja este campo vacío si no deseas cambiar la contraseña.</p>

        <br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <option
                value="Activo"
                <?= ($usuario['estado'] ?? '') === 'Activo' ? 'selected' : '' ?>
            >
                Activo
            </option>

            <option
                value="Inactivo"
                <?= ($usuario['estado'] ?? '') === 'Inactivo' ? 'selected' : '' ?>
            >
                Inactivo
            </option>

        </select>

        <br><br>

        <button type="submit">
            Guardar cambios
        </button>

        <a href="?controller=user&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>

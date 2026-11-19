
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
</head>

<body>

    <h1>Crear usuario</h1>

    <form method="POST" action="?controller=user&action=guardar">

        <label for="id_rol">Rol:</label>

        <select name="id_rol" id="id_rol" required>

            <option value="">Selecciona un rol</option>

            <?php foreach ($roles ?? [] as $rol): ?>

                <option
                    value="<?= htmlspecialchars((string) ($rol['id_rol'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
            required
        >

        <br><br>

        <label for="apellido">Apellido:</label>

        <input
            type="text"
            id="apellido"
            name="apellido"
            required
        >

        <br><br>

        <label for="correo">Correo electrónico:</label>

        <input
            type="email"
            id="correo"
            name="correo"
            required
        >

        <br><br>

        <label for="telefono">Teléfono:</label>

        <input
            type="text"
            id="telefono"
            name="telefono"
        >

        <br><br>

        <label for="password">Contraseña:</label>

        <input
            type="password"
            id="password"
            name="password"
            autocomplete="new-password"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar usuario
        </button>

        <a href="?controller=user&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>

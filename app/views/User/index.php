
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>

<body>

    <h1>Lista de Usuarios</h1>

    <a href="?controller=user&action=create">
        Crear usuario
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $usuarios = $usuarios ?? []; ?>

            <?php if ($usuarios): ?>

                <?php foreach ($usuarios as $usuario): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) ($usuario['id_usuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($usuario['rol_nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($usuario['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($usuario['apellido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($usuario['correo'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($usuario['telefono'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($usuario['estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <a href="?controller=user&action=edit&id=<?= urlencode((string) ($usuario['id_usuario'] ?? '')) ?>">
                                Editar
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="8">No hay usuarios registrados.</td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>

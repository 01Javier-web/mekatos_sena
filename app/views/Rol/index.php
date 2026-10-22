
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
</head>

<body>

    <h1>Lista de Roles</h1>

    <a href="?controller=rol&action=create">
        Crear rol
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $roles = $roles ?? []; ?>

            <?php if ($roles): ?>

                <?php foreach ($roles as $rol): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) ($rol['id_rol'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($rol['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($rol['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <a href="?controller=rol&action=edit&id=<?= urlencode((string) ($rol['id_rol'] ?? '')) ?>">
                                Editar
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="4">No hay roles registrados.</td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>

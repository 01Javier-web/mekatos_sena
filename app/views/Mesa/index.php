
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas</title>
</head>

<body>

    <h1>Lista de Mesas</h1>

    <a href="?controller=mesa&action=create">
        Crear mesa
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $mesas = $mesas ?? []; ?>

            <?php if ($mesas): ?>

                <?php foreach ($mesas as $mesa): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) ($mesa['id_mesa'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($mesa['numero'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($mesa['capacidad'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($mesa['estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <a href="?controller=mesa&action=edit&id=<?= urlencode((string) ($mesa['id_mesa'] ?? '')) ?>">
                                Editar
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5">No hay mesas registradas.</td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>

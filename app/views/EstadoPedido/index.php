
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estados de Pedido</title>
</head>

<body>

    <h1>Lista de Estados de Pedido</h1>

    <a href="?controller=estado_pedido&action=create">
        Crear estado
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $estados = $estados ?? []; ?>

            <?php if ($estados): ?>

                <?php foreach ($estados as $estado): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) ($estado['id_estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($estado['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <a href="?controller=estado_pedido&action=edit&id=<?= urlencode((string) ($estado['id_estado'] ?? '')) ?>">
                                Editar
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="3">No hay estados de pedidos registrados.</td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>

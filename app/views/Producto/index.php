
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>

<body>

    <h1>Lista de Productos</h1>

    <a href="?controller=producto&action=create">
        Crear producto
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php if ($productos ?? []): ?>

                <?php foreach ($productos ??[] as $producto): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) ($producto['id_producto'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($producto['categoria_nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($producto['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($producto['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($producto['precio'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($producto['estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <a href="?controller=producto&action=edit&id=<?= urlencode((string) ($producto['id_producto'] ?? '')) ?>">
                                Editar
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7">
                        No hay productos registrados.
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>

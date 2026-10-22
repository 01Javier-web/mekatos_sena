
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
</head>

<body>

    <h1>Lista de Categorías</h1>

    <a href="?controller=categoria&action=create">
        Crear categoría
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $categorias = $categorias ?? []; ?>

            <?php if ($categorias): ?>

                <?php foreach ($categorias as $categoria): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) ($categoria['id_categoria'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($categoria['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($categoria['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($categoria['estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <a href="?controller=categoria&action=edit&id=<?= urlencode((string) ($categoria['id_categoria'] ?? '')) ?>">
                                Editar
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5">No hay categorías registradas.</td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>

<?php
$categorias = $categorias ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
</head>

<body>

    <h1>Lista de Categorías</h1>

    <a href="?controller=categoria&action=crear">
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

            <?php if (!empty($categorias)): ?>

                <?php foreach ($categorias as $categoria): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string) $categoria['id_categoria'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) $categoria['nombre'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($categoria['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) $categoria['estado'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>

                            <a href="?controller=categoria&action=editar&id=<?= urlencode((string) $categoria['id_categoria']) ?>">
                                Editar
                            </a>

                            |

                            <form
                                method="POST"
                                action="?controller=categoria&action=eliminar"
                                style="display:inline;"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');"
                            >

                                <input
                                    type="hidden"
                                    name="id_categoria"
                                    value="<?= htmlspecialchars((string) $categoria['id_categoria'], ENT_QUOTES, 'UTF-8') ?>"
                                >

                                <button type="submit">
                                    Eliminar
                                </button>

                            </form>

                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5">
                        No hay categorías registradas.
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

    <br>

    <a href="index.php">
        Volver al inicio
    </a>

</body>

</html>

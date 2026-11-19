
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Pedido</title>
</head>

<body>

    <h1>Lista de Detalles de Pedido</h1>

    <a href="?controller=detalle_pedido&action=crear">
        Crear detalle
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pedido</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $detalles = $detalles ?? []; ?>

            <?php if (!empty($detalles)): ?>

                <?php foreach ($detalles as $detalle): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['id_detalle'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['producto_nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['cantidad'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['precio_unitario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['subtotal'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($detalle['observacion'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>

                            <a href="?controller=detalle_pedido&action=editar&id=<?= urlencode((string) ($detalle['id_detalle'] ?? '')) ?>">
                                Editar
                            </a>

                            |

                            <form
                                method="POST"
                                action="?controller=detalle_pedido&action=eliminar"
                                style="display:inline;"
                                onsubmit="return confirm('¿Estás seguro de eliminar este detalle?');"
                            >

                                <input
                                    type="hidden"
                                    name="id_detalle"
                                    value="<?= htmlspecialchars((string) ($detalle['id_detalle'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
                    <td colspan="8">
                        No hay detalles de pedido registrados.
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

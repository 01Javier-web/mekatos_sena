
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>

<body>

    <h1>Lista de Pedidos</h1>

    <a href="?controller=pedido&action=crear">
        Crear pedido
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Mesa</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $pedidos = $pedidos ?? []; ?>

            <?php if (!empty($pedidos)): ?>

                <?php foreach ($pedidos as $pedido): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['mesa_numero'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['usuario_nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['estado_nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['fecha_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['subtotal'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['descuento'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['total'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pedido['observaciones'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>

                            <a href="?controller=pedido&action=editar&id=<?= urlencode((string) ($pedido['id_pedido'] ?? '')) ?>">
                                Editar
                            </a>

                            |

                            <form
                                method="POST"
                                action="?controller=pedido&action=eliminar"
                                style="display:inline;"
                                onsubmit="return confirm('¿Estás seguro de eliminar este pedido?');"
                            >

                                <input
                                    type="hidden"
                                    name="id_pedido"
                                    value="<?= htmlspecialchars((string) ($pedido['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
                    <td colspan="10">
                        No hay pedidos registrados.
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

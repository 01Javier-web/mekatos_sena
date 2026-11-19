
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
</head>

<body>

    <h1>Lista de Facturas</h1>

    <a href="?controller=factura&action=crear">
        Crear factura
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pedido</th>
                <th>Número</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Impuesto</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $facturas = $facturas ?? []; ?>

            <?php if (!empty($facturas)): ?>

                <?php foreach ($facturas as $factura): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars((string) ($factura['id_factura'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['numero_factura'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['fecha_emision'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['subtotal'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['descuento'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['impuesto'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['total'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($factura['estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>

                            <a href="?controller=factura&action=editar&id=<?= urlencode((string) ($factura['id_factura'] ?? '')) ?>">
                                Editar
                            </a>

                            |

                            <form
                                method="POST"
                                action="?controller=factura&action=eliminar"
                                style="display:inline;"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta factura?');"
                            >

                                <input
                                    type="hidden"
                                    name="id_factura"
                                    value="<?= htmlspecialchars((string) ($factura['id_factura'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
                        No hay facturas registradas.
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

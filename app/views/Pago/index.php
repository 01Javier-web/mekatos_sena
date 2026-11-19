
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
</head>

<body>

    <h1>Lista de Pagos</h1>

    <a href="?controller=pago&action=crear">
        Crear pago
    </a>

    <br><br>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Factura</th>
                <th>Método de Pago</th>
                <th>Valor</th>
                <th>Referencia</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $pagos = $pagos ?? []; ?>

            <?php if (!empty($pagos)): ?>

                <?php foreach ($pagos as $pago): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars((string) ($pago['id_pago'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pago['numero_factura'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pago['metodo_pago_nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pago['valor'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pago['referencia'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pago['fecha_pago'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) ($pago['estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td>

                            <a href="?controller=pago&action=editar&id=<?= urlencode((string) ($pago['id_pago'] ?? '')) ?>">
                                Editar
                            </a>

                            |

                            <form
                                method="POST"
                                action="?controller=pago&action=eliminar"
                                style="display:inline;"
                                onsubmit="return confirm('¿Estás seguro de eliminar este pago?');"
                            >

                                <input
                                    type="hidden"
                                    name="id_pago"
                                    value="<?= htmlspecialchars((string) ($pago['id_pago'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
                        No hay pagos registrados.
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

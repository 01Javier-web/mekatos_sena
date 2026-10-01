<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Facturas</title>
</head>

<body>

    <h1>Lista de Facturas</h1>

    <a href="?controller=factura&action=create">
        Crear factura
    </a>

    <br><br>

    <table border="1">

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
        </tr>

        <?php foreach ($facturas ?? [] as $factura): ?>

            <tr>

                <td><?= $factura['id_factura'] ?? '' ?></td>

                <td><?= $factura['id_pedido'] ?? '' ?></td>

                <td><?= $factura['numero_factura'] ?? '' ?></td>

                <td><?= $factura['fecha_emision'] ?? '' ?></td>

                <td><?= $factura['subtotal'] ?? '' ?></td>

                <td><?= $factura['descuento'] ?? '' ?></td>

                <td><?= $factura['impuesto'] ?? '' ?></td>

                <td><?= $factura['total'] ?? '' ?></td>

                <td><?= $factura['estado'] ?? '' ?></td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
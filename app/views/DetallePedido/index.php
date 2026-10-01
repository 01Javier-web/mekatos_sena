<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles de Pedido</title>
</head>

<body>

    <h1>Lista de Detalles de Pedido</h1>

    <a href="?controller=detalle_pedido&action=create">
        Crear detalle
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>ID Pedido</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>Observación</th>
        </tr>

        <?php foreach ($detalles ?? [] as $detalle): ?>

            <tr>

                <td><?= $detalle['id_detalle'] ?? '' ?></td>

                <td><?= $detalle['id_pedido'] ?? '' ?></td>

                <td><?= $detalle['producto_nombre'] ?? '' ?></td>

                <td><?= $detalle['cantidad'] ?? '' ?></td>

                <td><?= $detalle['precio_unitario'] ?? '' ?></td>

                <td><?= $detalle['subtotal'] ?? '' ?></td>

                <td><?= $detalle['observacion'] ?? '' ?></td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
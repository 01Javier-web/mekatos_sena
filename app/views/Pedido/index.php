<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
</head>

<body>

    <h1>Lista de Pedidos</h1>

    <a href="?controller=pedido&action=create">
        Crear pedido
    </a>

    <br><br>

    <table border="1">

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
        </tr>

        <?php foreach ($pedidos ?? [] as $pedido): ?>

            <tr>

                <td><?= $pedido['id_pedido'] ?? '' ?></td>

                <td><?= $pedido['mesa_numero'] ?? '' ?></td>

                <td><?= $pedido['usuario_nombre'] ?? '' ?></td>

                <td><?= $pedido['estado_nombre'] ?? '' ?></td>

                <td><?= $pedido['fecha_pedido'] ?? '' ?></td>

                <td><?= $pedido['subtotal'] ?? '' ?></td>

                <td><?= $pedido['descuento'] ?? '' ?></td>

                <td><?= $pedido['total'] ?? '' ?></td>

                <td><?= $pedido['observaciones'] ?? '' ?></td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pagos</title>
</head>

<body>

    <h1>Lista de Pagos</h1>

    <a href="?controller=pago&action=create">
        Crear pago
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Factura</th>
            <th>Método de Pago</th>
            <th>Valor</th>
            <th>Referencia</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>

        <?php foreach ($pagos ?? [] as $pago): ?>

            <tr>

                <td><?= $pago['id_pago'] ?? '' ?></td>

                <td><?= $pago['numero_factura'] ?? '' ?></td>

                <td><?= $pago['metodo_pago_nombre'] ?? '' ?></td>

                <td><?= $pago['valor'] ?? '' ?></td>

                <td><?= $pago['referencia'] ?? '' ?></td>

                <td><?= $pago['fecha_pago'] ?? '' ?></td>

                <td><?= $pago['estado'] ?? '' ?></td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Estados de Pedido</title>
</head>

<body>

    <h1>Lista de Estados de Pedido</h1>

    <a href="?controller=estado_pedido&action=create">
        Crear estado
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>

        <?php foreach ($estados ?? [] as $estado): ?>

            <tr>

                <td>
                    <?= $estado['id_estado'] ?? '' ?>
                </td>

                <td>
                    <?= $estado['nombre'] ?? '' ?>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
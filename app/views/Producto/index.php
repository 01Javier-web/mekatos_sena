<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>

<body>

    <h1>Lista de Productos</h1>

    <a href="?controller=producto&action=create">
        Crear producto
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Estado</th>
        </tr>

        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>

                <tr>
                    <td><?= $producto['id_producto'] ?></td>
                    <td><?= $producto['categoria_nombre'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['descripcion'] ?></td>
                    <td><?= $producto['precio'] ?></td>
                    <td><?= $producto['estado'] ?></td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay productos registrados.</td>
            </tr>
        <?php endif; ?>

    </table>

</body>

</html>
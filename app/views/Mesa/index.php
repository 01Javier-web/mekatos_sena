<table border="1">

    <tr>
        <th>ID</th>
        <th>Categoría</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Estado</th>
    </tr>

    <?php foreach (($productos ?? []) as $producto): ?>

        <tr>
            <td><?= $producto['id_producto'] ?></td>
            <td><?= $producto['categoria_nombre'] ?></td>
            <td><?= $producto['nombre'] ?></td>
            <td><?= $producto['descripcion'] ?></td>
            <td><?= $producto['precio'] ?></td>
            <td><?= $producto['estado'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>
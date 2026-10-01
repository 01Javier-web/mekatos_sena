<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
</head>

<body>

    <h1>Lista de Categorías</h1>

    <a href="?controller=categoria&action=create">
        Crear categoría
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>

        <?php $categorias = $categorias ?? []; ?>
        <?php foreach ($categorias as $categoria): ?>

            <tr>
                <td><?= $categoria['id_categoria'] ?? '' ?></td>
                <td><?= $categoria['nombre'] ?? '' ?></td>
                <td><?= $categoria['descripcion'] ?? '' ?></td>
                <td><?= $categoria['estado'] ?? '' ?></td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
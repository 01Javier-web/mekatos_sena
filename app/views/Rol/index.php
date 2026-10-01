<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Roles</title>
</head>

<body>

    <h1>Lista de Roles</h1>

    <a href="?controller=rol&action=create">
        Crear rol
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>

        <?php foreach (($roles ?? []) as $rol): ?>

            <tr>

                <td>
                    <?= $rol['id_rol'] ?? '' ?>
                </td>

                <td>
                    <?= $rol['nombre'] ?? '' ?>
                </td>

                <td>
                    <?= $rol['descripcion'] ?? '' ?>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
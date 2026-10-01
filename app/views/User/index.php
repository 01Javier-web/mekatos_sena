<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>

<body>

    <h1>Lista de Usuarios</h1>

    <a href="?controller=user&action=create">
        Crear usuario
    </a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Estado</th>
        </tr>

        <?php foreach ($usuarios ?? [] as $usuario): ?>

            <tr>

                <td>
                    <?= $usuario['id_usuario'] ?? '' ?>
                </td>

                <td>
                    <?= $usuario['rol_nombre'] ?? '' ?>
                </td>

                <td>
                    <?= $usuario['nombre'] ?? '' ?>
                </td>

                <td>
                    <?= $usuario['apellido'] ?? '' ?>
                </td>

                <td>
                    <?= $usuario['correo'] ?? '' ?>
                </td>

                <td>
                    <?= $usuario['telefono'] ?? '' ?>
                </td>

                <td>
                    <?= $usuario['estado'] ?? '' ?>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
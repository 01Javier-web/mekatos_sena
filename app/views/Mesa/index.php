<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mesas</title>
</head>
<body>

    <h1>Listado de Mesas</h1>

    <a href="/mesas/create">Nueva Mesa</a>

    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach (($mesas ?? []) as $mesa): ?>

                <tr>

                    <td>
                        <?= $mesa['id'] ?><ff
                    </td>

                    <td>
                        <?= $mesa['number'] ?>
                    </td>

                    <td>
                        <?= $mesa['name'] ?>
                    </td>

                    <td>
                        <?= $mesa['capacity'] ?>
                    </td>

                    <td>
                        <?= $mesa['status'] ?>
                    </td>

                    <td>

                        <a href="/mesas/show/<?= $mesa['id'] ?>">
                            Ver
                        </a>

                        <a href="/mesas/edit/<?= $mesa['id'] ?>">
                            Editar
                        </a>

                        <a href="/mesas/delete/<?= $mesa['id'] ?>"
                           onclick="return confirm('¿Está seguro de eliminar esta mesa?')">
                            Eliminar
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</body>
</html>
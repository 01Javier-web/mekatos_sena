<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Estado de Pedido</title>
</head>

<body>

    <h1>Crear Estado de Pedido</h1>

    <form method="POST" action="?controller=estado_pedido&action=guardar">

        <label>Nombre:</label>

        <input type="text" name="nombre" required>

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=estado_pedido&action=index">
        Ver estados
    </a>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Detalle de Pedido</title>
</head>

<body>

    <h1>Crear Detalle de Pedido</h1>

    <form method="POST" action="?controller=detalle_pedido&action=guardar">

        <label>ID Pedido:</label>
        <input type="number" name="id_pedido" required>

        <br><br>

        <label>ID Producto:</label>
        <input type="number" name="id_producto" required>

        <br><br>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" required>

        <br><br>

        <label>Precio Unitario:</label>
        <input type="number" name="precio_unitario" step="0.01" required>

        <br><br>

        <label>Subtotal:</label>
        <input type="number" name="subtotal" step="0.01" required>

        <br><br>

        <label>Observación:</label>
        <input type="text" name="observacion">

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=detalle_pedido&action=index">
        Ver detalles
    </a>

</body>

</html>
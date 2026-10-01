<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Pedido</title>
</head>

<body>

    <h1>Crear Pedido</h1>

    <form method="POST" action="?controller=pedido&action=guardar">

        <label>ID Mesa:</label>
        <input type="number" name="id_mesa" required>

        <br><br>

        <label>ID Usuario:</label>
        <input type="number" name="id_usuario" required>

        <br><br>

        <label>ID Estado:</label>
        <input type="number" name="id_estado" required>

        <br><br>

        <label>Fecha del Pedido:</label>
        <input type="datetime-local" name="fecha_pedido" required>

        <br><br>

        <label>Subtotal:</label>
        <input type="number" name="subtotal" step="0.01" required>

        <br><br>

        <label>Descuento:</label>
        <input type="number" name="descuento" step="0.01" value="0">

        <br><br>

        <label>Total:</label>
        <input type="number" name="total" step="0.01" required>

        <br><br>

        <label>Observaciones:</label>
        <input type="text" name="observaciones">

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=pedido&action=index">
        Ver pedidos
    </a>

</body>

</html>
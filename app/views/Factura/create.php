<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Factura</title>
</head>

<body>

    <h1>Crear Factura</h1>

    <form method="POST" action="?controller=factura&action=guardar">

        <label>ID Pedido:</label>
        <input type="number" name="id_pedido" required>

        <br><br>

        <label>Número de Factura:</label>
        <input type="text" name="numero_factura" required>

        <br><br>

        <label>Fecha de Emisión:</label>
        <input type="datetime-local" name="fecha_emision" required>

        <br><br>

        <label>Subtotal:</label>
        <input type="number" name="subtotal" step="0.01" required>

        <br><br>

        <label>Descuento:</label>
        <input type="number" name="descuento" step="0.01" value="0">

        <br><br>

        <label>Impuesto:</label>
        <input type="number" name="impuesto" step="0.01" value="0">

        <br><br>

        <label>Total:</label>
        <input type="number" name="total" step="0.01" required>

        <br><br>

        <label>Estado:</label>

        <select name="estado">

            <option value="Pendiente">Pendiente</option>
            <option value="Pagada">Pagada</option>
            <option value="Anulada">Anulada</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=factura&action=index">
        Ver facturas
    </a>

</body>

</html>
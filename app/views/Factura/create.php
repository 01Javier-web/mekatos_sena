
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Factura</title>
</head>

<body>

    <h1>Crear Factura</h1>

    <?php
    $pedidos = $pedidos ?? [];
    ?>

    <form method="POST" action="?controller=factura&action=guardar">

        <label for="id_pedido">Pedido:</label>

        <select name="id_pedido" id="id_pedido" required>

            <option value="">Seleccione un pedido</option>

            <?php foreach ($pedidos as $pedido): ?>

                <option value="<?= htmlspecialchars((string) $pedido['id_pedido'], ENT_QUOTES, 'UTF-8') ?>">
                    Pedido #<?= htmlspecialchars((string) $pedido['id_pedido'], ENT_QUOTES, 'UTF-8') ?>
                    - Total: $<?= htmlspecialchars((string) ($pedido['total'] ?? '0'), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="numero_factura">Número de Factura:</label>
        <input
            type="text"
            name="numero_factura"
            id="numero_factura"
            required
        >

        <br><br>

        <label for="fecha_emision">Fecha de Emisión:</label>
        <input
            type="datetime-local"
            name="fecha_emision"
            id="fecha_emision"
            required
        >

        <br><br>

        <label for="subtotal">Subtotal:</label>
        <input
            type="number"
            name="subtotal"
            id="subtotal"
            step="0.01"
            min="0"
            required
        >

        <br><br>

        <label for="descuento">Descuento:</label>
        <input
            type="number"
            name="descuento"
            id="descuento"
            step="0.01"
            min="0"
            value="0"
        >

        <br><br>

        <label for="impuesto">Impuesto:</label>
        <input
            type="number"
            name="impuesto"
            id="impuesto"
            step="0.01"
            min="0"
            value="0"
        >

        <br><br>

        <label for="total">Total:</label>
        <input
            type="number"
            name="total"
            id="total"
            step="0.01"
            min="0"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <option value="Pendiente">Pendiente</option>
            <option value="Pagada">Pagada</option>
            <option value="Anulada">Anulada</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar factura
        </button>

    </form>

    <br>

    <a href="?controller=factura&action=index">
        Volver a facturas
    </a>

</body>

</html>


<?php
$pedidos = $pedidos ?? [];
$productos = $productos ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear detalle de pedido</title>
</head>

<body>

    <h1>Crear detalle de pedido</h1>

    <form method="POST" action="?controller=detalle_pedido&action=guardar">

        <label for="id_pedido">Pedido:</label>

        <select name="id_pedido" id="id_pedido" required>

            <option value="">Selecciona un pedido</option>

            <?php foreach ($pedidos as $pedido): ?>

                <option
                    value="<?= htmlspecialchars((string) ($pedido['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                >
                    Pedido #<?= htmlspecialchars((string) ($pedido['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="id_producto">Producto:</label>

        <select name="id_producto" id="id_producto" required>

            <option value="">Selecciona un producto</option>

            <?php foreach ($productos as $producto): ?>

                <option
                    value="<?= htmlspecialchars((string) ($producto['id_producto'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                >
                    <?= htmlspecialchars((string) ($producto['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="cantidad">Cantidad:</label>

        <input
            type="number"
            id="cantidad"
            name="cantidad"
            min="0.01"
            step="0.01"
            required
        >

        <br><br>

        <label for="precio_unitario">Precio unitario:</label>

        <input
            type="number"
            id="precio_unitario"
            name="precio_unitario"
            min="0"
            step="0.01"
            required
        >

        <br><br>

        <label for="subtotal">Subtotal:</label>

        <input
            type="number"
            id="subtotal"
            name="subtotal"
            min="0"
            step="0.01"
            required
        >

        <br><br>

        <label for="observacion">Observación:</label>

        <input
            type="text"
            id="observacion"
            name="observacion"
        >

        <br><br>

        <button type="submit">
            Guardar detalle
        </button>

        <a href="?controller=detalle_pedido&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>

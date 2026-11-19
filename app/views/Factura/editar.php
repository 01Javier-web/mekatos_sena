
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
</head>

<body>

    <h1>Editar Factura</h1>

    <?php
    $factura = $factura ?? [];
    $pedidos = $pedidos ?? [];

    $fechaEmision = '';

    if (!empty($factura['fecha_emision'])) {
        $fechaEmision = date(
            'Y-m-d\TH:i',
            strtotime($factura['fecha_emision'])
        );
    }
    ?>

    <form method="POST" action="?controller=factura&action=actualizar">

        <input
            type="hidden"
            name="id_factura"
            value="<?= htmlspecialchars((string) ($factura['id_factura'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="id_pedido">Pedido:</label>

        <select name="id_pedido" id="id_pedido" required>

            <option value="">Seleccione un pedido</option>

            <?php foreach ($pedidos as $pedido): ?>

                <option
                    value="<?= htmlspecialchars((string) $pedido['id_pedido'], ENT_QUOTES, 'UTF-8') ?>"
                    <?= (string) ($factura['id_pedido'] ?? '') === (string) $pedido['id_pedido'] ? 'selected' : '' ?>
                >
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
            value="<?= htmlspecialchars((string) ($factura['numero_factura'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="fecha_emision">Fecha de Emisión:</label>

        <input
            type="datetime-local"
            name="fecha_emision"
            id="fecha_emision"
            value="<?= htmlspecialchars($fechaEmision, ENT_QUOTES, 'UTF-8') ?>"
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
            value="<?= htmlspecialchars((string) ($factura['subtotal'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
            value="<?= htmlspecialchars((string) ($factura['descuento'] ?? '0'), ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label for="impuesto">Impuesto:</label>

        <input
            type="number"
            name="impuesto"
            id="impuesto"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars((string) ($factura['impuesto'] ?? '0'), ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label for="total">Total:</label>

        <input
            type="number"
            name="total"
            id="total"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars((string) ($factura['total'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <?php
            $estados = ['Pendiente', 'Pagada', 'Anulada'];
            $estadoActual = $factura['estado'] ?? 'Pendiente';
            ?>

            <?php foreach ($estados as $estado): ?>

                <option
                    value="<?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?>"
                    <?= $estadoActual === $estado ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">
            Actualizar factura
        </button>

    </form>

    <br>

    <a href="?controller=factura&action=index">
        Cancelar y volver a facturas
    </a>

</body>

</html>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pago</title>
</head>

<body>

    <h1>Editar Pago</h1>

    <?php
    $pago = $pago ?? [];
    $facturas = $facturas ?? [];
    $metodosPago = $metodosPago ?? [];

    $fechaPago = '';

    if (!empty($pago['fecha_pago'])) {
        $fechaPago = date(
            'Y-m-d\TH:i',
            strtotime($pago['fecha_pago'])
        );
    }

    $estados = [
        'Pendiente',
        'Completado',
        'Cancelado'
    ];
    ?>

    <form method="POST" action="?controller=pago&action=actualizar">

        <input
            type="hidden"
            name="id_pago"
            value="<?= htmlspecialchars((string) ($pago['id_pago'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="id_factura">Factura:</label>

        <select name="id_factura" id="id_factura" required>

            <option value="">Seleccione una factura</option>

            <?php foreach ($facturas as $factura): ?>

                <option
                    value="<?= htmlspecialchars((string) $factura['id_factura'], ENT_QUOTES, 'UTF-8') ?>"
                    <?= (string) ($pago['id_factura'] ?? '') === (string) $factura['id_factura'] ? 'selected' : '' ?>
                >
                    Factura #<?= htmlspecialchars((string) $factura['numero_factura'], ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="id_metodo_pago">Método de Pago:</label>

        <select name="id_metodo_pago" id="id_metodo_pago" required>

            <option value="">Seleccione un método de pago</option>

            <?php foreach ($metodosPago as $metodo): ?>

                <option
                    value="<?= htmlspecialchars((string) $metodo['id_metodo_pago'], ENT_QUOTES, 'UTF-8') ?>"
                    <?= (string) ($pago['id_metodo_pago'] ?? '') === (string) $metodo['id_metodo_pago'] ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars((string) $metodo['nombre'], ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="valor">Valor:</label>

        <input
            type="number"
            name="valor"
            id="valor"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars((string) ($pago['valor'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="referencia">Referencia:</label>

        <input
            type="text"
            name="referencia"
            id="referencia"
            value="<?= htmlspecialchars((string) ($pago['referencia'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label for="fecha_pago">Fecha de Pago:</label>

        <input
            type="datetime-local"
            name="fecha_pago"
            id="fecha_pago"
            value="<?= htmlspecialchars($fechaPago, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <?php foreach ($estados as $estado): ?>

                <option
                    value="<?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?>"
                    <?= ($pago['estado'] ?? 'Pendiente') === $estado ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">
            Actualizar pago
        </button>

    </form>

    <br>

    <a href="?controller=pago&action=index">
        Cancelar y volver a pagos
    </a>

</body>

</html>

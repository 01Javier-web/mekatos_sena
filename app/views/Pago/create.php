
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pago</title>
</head>

<body>

    <h1>Crear Pago</h1>

    <?php
    $facturas = $facturas ?? [];
    $metodosPago = $metodosPago ?? [];
    ?>

    <form method="POST" action="?controller=pago&action=guardar">

        <label for="id_factura">Factura:</label>

        <select name="id_factura" id="id_factura" required>

            <option value="">Seleccione una factura</option>

            <?php foreach ($facturas as $factura): ?>

                <option value="<?= htmlspecialchars((string) $factura['id_factura'], ENT_QUOTES, 'UTF-8') ?>">
                    Factura #<?= htmlspecialchars((string) $factura['numero_factura'], ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="id_metodo_pago">Método de Pago:</label>

        <select name="id_metodo_pago" id="id_metodo_pago" required>

            <option value="">Seleccione un método de pago</option>

            <?php foreach ($metodosPago as $metodo): ?>

                <option value="<?= htmlspecialchars((string) $metodo['id_metodo_pago'], ENT_QUOTES, 'UTF-8') ?>">
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
            required
        >

        <br><br>

        <label for="referencia">Referencia:</label>

        <input
            type="text"
            name="referencia"
            id="referencia"
        >

        <br><br>

        <label for="fecha_pago">Fecha de Pago:</label>

        <input
            type="datetime-local"
            name="fecha_pago"
            id="fecha_pago"
            required
        >

        <br><br>

        <label for="estado">Estado:</label>

        <select name="estado" id="estado" required>

            <option value="Pendiente">Pendiente</option>
            <option value="Completado">Completado</option>
            <option value="Cancelado">Cancelado</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar pago
        </button>

    </form>

    <br>

    <a href="?controller=pago&action=index">
        Volver a pagos
    </a>

</body>

</html>

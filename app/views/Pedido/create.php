
<?php
$mesas = $mesas ?? [];
$usuarios = $usuarios ?? [];
$estados = $estados ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear pedido</title>
</head>

<body>

    <h1>Crear pedido</h1>

    <form method="POST" action="?controller=pedido&action=guardar">

        <label for="id_mesa">Mesa:</label>

        <select name="id_mesa" id="id_mesa" required>

            <option value="">Selecciona una mesa</option>

            <?php foreach ($mesas as $mesa): ?>

                <option
                    value="<?= htmlspecialchars((string) ($mesa['id_mesa'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                >
                    Mesa <?= htmlspecialchars((string) ($mesa['numero'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="id_usuario">Usuario:</label>

        <select name="id_usuario" id="id_usuario" required>

            <option value="">Selecciona un usuario</option>

            <?php foreach ($usuarios as $usuario): ?>

                <option
                    value="<?= htmlspecialchars((string) ($usuario['id_usuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                >
                    <?= htmlspecialchars(
                        trim(($usuario['nombre'] ?? '') . ' ' . ($usuario['apellido'] ?? '')),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="id_estado">Estado:</label>

        <select name="id_estado" id="id_estado" required>

            <option value="">Selecciona un estado</option>

            <?php foreach ($estados as $estado): ?>

                <option
                    value="<?= htmlspecialchars((string) ($estado['id_estado'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                >
                    <?= htmlspecialchars((string) ($estado['nombre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="fecha_pedido">Fecha del pedido:</label>

        <input
            type="datetime-local"
            id="fecha_pedido"
            name="fecha_pedido"
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

        <label for="descuento">Descuento:</label>

        <input
            type="number"
            id="descuento"
            name="descuento"
            min="0"
            step="0.01"
            value="0"
            required
        >

        <br><br>

        <label for="total">Total:</label>

        <input
            type="number"
            id="total"
            name="total"
            min="0"
            step="0.01"
            required
        >

        <br><br>

        <label for="observaciones">Observaciones:</label>

        <textarea
            id="observaciones"
            name="observaciones"
        ></textarea>

        <br><br>

        <button type="submit">
            Guardar pedido
        </button>

        <a href="?controller=pedido&action=index">
            Cancelar
        </a>

    </form>

</body>

</html>

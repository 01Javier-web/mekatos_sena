
<?php
$pedido = $pedido ?? [];
$mesas = $mesas ?? [];
$usuarios = $usuarios ?? [];
$estados = $estados ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido</title>
</head>

<body>

    <h1>Editar pedido</h1>

    <form method="POST" action="?controller=pedido&action=actualizar">

        <input
            type="hidden"
            name="id_pedido"
            value="<?= htmlspecialchars((string) ($pedido['id_pedido'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <label for="id_mesa">Mesa:</label>
        <select name="id_mesa" id="id_mesa" required>
            <option value="">Selecciona una mesa</option>

            <?php foreach ($mesas as $mesa): ?>
                <option
                    value="<?= htmlspecialchars((string) ($mesa['id_mesa'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                    <?= (string) ($mesa['id_mesa'] ?? '') === (string) ($pedido['id_mesa'] ?? '') ? 'selected' : '' ?>
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
                    <?= (string) ($usuario['id_usuario'] ?? '') === (string) ($pedido['id_usuario'] ?? '') ? 'selected' : '' ?>
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
                    <?= (string) ($estado['id_estado'] ?? '') === (string) ($pedido['id_estado'] ?? '') ? 'selected' : '' ?>
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
            value="<?= htmlspecialchars(
                str_replace(' ', 'T', substr((string) ($pedido['fecha_pedido'] ?? ''), 0, 16)),
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
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
            value="<?= htmlspecialchars((string) ($pedido['subtotal'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
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
            value="<?= htmlspecialchars((string) ($pedido['descuento'] ?? '0'), ENT_QUOTES, 'UTF-8') ?>"
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
            value="<?= htmlspecialchars((string) ($pedido['total'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones"><?= htmlspecialchars(
            (string) ($pedido['observaciones'] ?? ''),
            ENT_QUOTES,
            'UTF-8'
        ) ?></textarea>

        <br><br>

        <button type="submit">Guardar cambios</button>
        <a href="?controller=pedido&action=index">Cancelar</a>

    </form>

</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Pago</title>
</head>

<body>

    <h1>Crear Pago</h1>

    <form method="POST" action="?controller=pago&action=guardar">

        <label>ID Factura:</label>
        <input type="number" name="id_factura" required>

        <br><br>

        <label>ID Método de Pago:</label>
        <input type="number" name="id_metodo_pago" required>

        <br><br>

        <label>Valor:</label>
        <input type="number" name="valor" step="0.01" required>

        <br><br>

        <label>Referencia:</label>
        <input type="text" name="referencia">

        <br><br>

        <label>Fecha de Pago:</label>
        <input type="datetime-local" name="fecha_pago" required>

        <br><br>

        <label>Estado:</label>

        <select name="estado">

            <option value="Pendiente">Pendiente</option>
            <option value="Completado">Completado</option>
            <option value="Cancelado">Cancelado</option>

        </select>

        <br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

    <br>

    <a href="?controller=pago&action=index">
        Ver pagos
    </a>

</body>

</html>
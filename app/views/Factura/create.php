<form action="" method="POST">

    <h2>Crear Factura</h2>

    <div>
        <label for="id_pedido">ID de pedido:</label>
        <input
            type="number"
            id="id_pedido"
            name="id_pedido"
            min="1"
            required
        >
    </div>

    <div>
        <label for="numero_factura">Número de factura:</label>
        <input
            type="text"
            id="numero_factura"
            name="numero_factura"
            maxlength="50"
            required
        >
    </div>

    <div>
        <label for="fecha_emision">Fecha de emisión:</label>
        <input
            type="datetime-local"
            id="fecha_emision"
            name="fecha_emision"
        >
    </div>

    <div>
        <label for="subtotal">Subtotal:</label>
        <input
            type="number"
            id="subtotal"
            name="subtotal"
            step="0.01"
            min="0"
            required
        >
    </div>

    <div>
        <label for="descuento">Descuento:</label>
        <input
            type="number"
            id="descuento"
            name="descuento"
            step="0.01"
            min="0"
            value="0"
        >
    </div>

    <div>
        <label for="impuesto">Impuesto:</label>
        <input
            type="number"
            id="impuesto"
            name="impuesto"
            step="0.01"
            min="0"
            value="0"
        >
    </div>

    <div>
        <label for="total">Total:</label>
        <input
            type="number"
            id="total"
            name="total"
            step="0.01"
            min="0"
            required
        >
    </div>

    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="Pendiente">Pendiente</option>
            <option value="Pagada">Pagada</option>
            <option value="Anulada">Anulada</option>
        </select>
    </div>

    <div>
        <button type="submit">Guardar Factura</button>
    </div>

</form>
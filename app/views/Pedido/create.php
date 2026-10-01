<form action="" method="POST">

    <h2>Crear Pedido</h2>

    <div>
        <label for="id_mesa">ID de mesa:</label>
        <input
            type="number"
            id="id_mesa"
            name="id_mesa"
            min="1"
            required
        >
    </div>

    <div>
        <label for="id_usuario">ID de usuario:</label>
        <input
            type="number"
            id="id_usuario"
            name="id_usuario"
            min="1"
            required
        >
    </div>

    <div>
        <label for="id_estado">ID de estado:</label>
        <input
            type="number"
            id="id_estado"
            name="id_estado"
            min="1"
            required
        >
    </div>

    <div>
        <label for="fecha_pedido">Fecha del pedido:</label>
        <input
            type="datetime-local"
            id="fecha_pedido"
            name="fecha_pedido"
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
            value="0"
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
        <label for="total">Total:</label>
        <input
            type="number"
            id="total"
            name="total"
            step="0.01"
            min="0"
            value="0"
        >
    </div>

    <div>
        <label for="observaciones">Observaciones:</label>
        <textarea
            id="observaciones"
            name="observaciones"
            maxlength="255"
        ></textarea>
    </div>

    <div>
        <button type="submit">Guardar Pedido</button>
    </div>

</form>
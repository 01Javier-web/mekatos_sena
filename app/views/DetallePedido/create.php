<form action="" method="POST">

    <h2>Agregar Detalle al Pedido</h2>

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
        <label for="id_producto">ID de producto:</label>
        <input
            type="number"
            id="id_producto"
            name="id_producto"
            min="1"
            required
        >
    </div>

    <div>
        <label for="cantidad">Cantidad:</label>
        <input
            type="number"
            id="cantidad"
            name="cantidad"
            min="1"
            required
        >
    </div>

    <div>
        <label for="precio_unitario">Precio unitario:</label>
        <input
            type="number"
            id="precio_unitario"
            name="precio_unitario"
            step="0.01"
            min="0"
            required
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
        <label for="observacion">Observación:</label>
        <textarea
            id="observacion"
            name="observacion"
            maxlength="255"
        ></textarea>
    </div>

    <div>
        <button type="submit">Guardar Detalle</button>
    </div>

</form>
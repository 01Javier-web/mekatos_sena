<form action="" method="POST">

    <h2>Registrar Pago</h2>

    <div>
        <label for="id_factura">ID de factura:</label>
        <input
            type="number"
            id="id_factura"
            name="id_factura"
            min="1"
            required
        >
    </div>

    <div>
        <label for="id_metodo_pago">ID de método de pago:</label>
        <input
            type="number"
            id="id_metodo_pago"
            name="id_metodo_pago"
            min="1"
            required
        >
    </div>

    <div>
        <label for="valor">Valor:</label>
        <input
            type="number"
            id="valor"
            name="valor"
            step="0.01"
            min="0"
            required
        >
    </div>

    <div>
        <label for="referencia">Referencia:</label>
        <input
            type="text"
            id="referencia"
            name="referencia"
            maxlength="100"
        >
    </div>

    <div>
        <label for="fecha_pago">Fecha de pago:</label>
        <input
            type="datetime-local"
            id="fecha_pago"
            name="fecha_pago"
        >
    </div>

    <div>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="Pendiente">Pendiente</option>
            <option value="Completado">Completado</option>
            <option value="Cancelado">Cancelado</option>
        </select>
    </div>

    <div>
        <button type="submit">Registrar Pago</button>
    </div>

</form>

<?php

require_once __DIR__ . '/../../config/database.php';

class DetallePedido
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Consultar todos los detalles de pedido.
    public function getAll()
    {
        $sql = "SELECT
                    d.id_detalle,
                    d.id_pedido,
                    d.id_producto,
                    p.nombre AS producto_nombre,
                    d.cantidad,
                    d.precio_unitario,
                    d.subtotal,
                    d.observacion
                FROM detalle_pedido AS d
                INNER JOIN producto AS p
                    ON d.id_producto = p.id_producto
                ORDER BY d.id_detalle ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar un detalle por su ID.
    public function getById($id)
    {
        $sql = "SELECT
                    id_detalle,
                    id_pedido,
                    id_producto,
                    cantidad,
                    precio_unitario,
                    subtotal,
                    observacion
                FROM detalle_pedido
                WHERE id_detalle = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un detalle de pedido.
    public function crear(
        $id_pedido,
        $id_producto,
        $cantidad,
        $precio_unitario,
        $subtotal,
        $observacion
    ) {
        $sql = "INSERT INTO detalle_pedido
                    (
                        id_pedido,
                        id_producto,
                        cantidad,
                        precio_unitario,
                        subtotal,
                        observacion
                    )
                VALUES
                    (
                        :id_pedido,
                        :id_producto,
                        :cantidad,
                        :precio_unitario,
                        :subtotal,
                        :observacion
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad', $cantidad);
        $consulta->bindValue(':precio_unitario', $precio_unitario);
        $consulta->bindValue(':subtotal', $subtotal);
        $consulta->bindValue(':observacion', $observacion);

        return $consulta->execute();
    }

    // Actualizar un detalle de pedido.
    public function actualizar(
        $id,
        $id_pedido,
        $id_producto,
        $cantidad,
        $precio_unitario,
        $subtotal,
        $observacion
    ) {
        $sql = "UPDATE detalle_pedido
                SET
                    id_pedido = :id_pedido,
                    id_producto = :id_producto,
                    cantidad = :cantidad,
                    precio_unitario = :precio_unitario,
                    subtotal = :subtotal,
                    observacion = :observacion
                WHERE id_detalle = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad', $cantidad);
        $consulta->bindValue(':precio_unitario', $precio_unitario);
        $consulta->bindValue(':subtotal', $subtotal);
        $consulta->bindValue(':observacion', $observacion);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Eliminar un detalle de pedido.
    public function eliminar($id)
    {
        $sql = "DELETE FROM detalle_pedido
                WHERE id_detalle = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Compatibilidad con el método anterior.
    public function create(
        $id_pedido,
        $id_producto,
        $cantidad,
        $precio_unitario,
        $subtotal,
        $observacion
    ) {
        return $this->crear(
            $id_pedido,
            $id_producto,
            $cantidad,
            $precio_unitario,
            $subtotal,
            $observacion
        );
    }
}

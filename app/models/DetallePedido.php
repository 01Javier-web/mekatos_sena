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

    public function getAll()
    {
        $sql = "SELECT * FROM detalle_pedido";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_detalle)
    {
        $sql = "SELECT * FROM detalle_pedido WHERE id_detalle = :id_detalle";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_detalle', $id_detalle);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_pedido, $id_producto, $cantidad, $precio_unitario, $subtotal, $observacion)
    {
        $sql = "INSERT INTO detalle_pedido
                (id_pedido, id_producto, cantidad, precio_unitario, subtotal, observacion)
                VALUES
                (:id_pedido, :id_producto, :cantidad, :precio_unitario, :subtotal, :observacion)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->bindParam(':id_producto', $id_producto);
        $consulta->bindParam(':cantidad', $cantidad);
        $consulta->bindParam(':precio_unitario', $precio_unitario);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':observacion', $observacion);

        return $consulta->execute();
    }

    public function update($id_detalle, $id_pedido, $id_producto, $cantidad, $precio_unitario, $subtotal, $observacion)
    {
        $sql = "UPDATE detalle_pedido
                SET id_pedido = :id_pedido,
                    id_producto = :id_producto,
                    cantidad = :cantidad,
                    precio_unitario = :precio_unitario,
                    subtotal = :subtotal,
                    observacion = :observacion
                WHERE id_detalle = :id_detalle";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_detalle', $id_detalle);
        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->bindParam(':id_producto', $id_producto);
        $consulta->bindParam(':cantidad', $cantidad);
        $consulta->bindParam(':precio_unitario', $precio_unitario);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':observacion', $observacion);

        return $consulta->execute();
    }

    public function delete($id_detalle)
    {
        $sql = "DELETE FROM detalle_pedido WHERE id_detalle = :id_detalle";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_detalle', $id_detalle);

        return $consulta->execute();
    }
}
?>
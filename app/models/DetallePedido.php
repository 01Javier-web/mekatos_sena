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
                ORDER BY d.id_detalle DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(
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

        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->bindParam(':id_producto', $id_producto);
        $consulta->bindParam(':cantidad', $cantidad);
        $consulta->bindParam(':precio_unitario', $precio_unitario);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':observacion', $observacion);

        return $consulta->execute();
    }
}
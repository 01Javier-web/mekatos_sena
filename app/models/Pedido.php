<?php

require_once __DIR__ . '/../../config/database.php';

class Pedido
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM pedido";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_pedido)
    {
        $sql = "SELECT * FROM pedido WHERE id_pedido = :id_pedido";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_mesa, $id_usuario, $id_estado, $fecha_pedido, $subtotal, $descuento, $total, $observaciones)
    {
        $sql = "INSERT INTO pedido
                (id_mesa, id_usuario, id_estado, fecha_pedido, subtotal, descuento, total, observaciones)
                VALUES
                (:id_mesa, :id_usuario, :id_estado, :fecha_pedido, :subtotal, :descuento, :total, :observaciones)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_mesa', $id_mesa);
        $consulta->bindParam(':id_usuario', $id_usuario);
        $consulta->bindParam(':id_estado', $id_estado);
        $consulta->bindParam(':fecha_pedido', $fecha_pedido);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':descuento', $descuento);
        $consulta->bindParam(':total', $total);
        $consulta->bindParam(':observaciones', $observaciones);

        return $consulta->execute();
    }

    public function update($id_pedido, $id_mesa, $id_usuario, $id_estado, $fecha_pedido, $subtotal, $descuento, $total, $observaciones)
    {
        $sql = "UPDATE pedido
                SET id_mesa = :id_mesa,
                    id_usuario = :id_usuario,
                    id_estado = :id_estado,
                    fecha_pedido = :fecha_pedido,
                    subtotal = :subtotal,
                    descuento = :descuento,
                    total = :total,
                    observaciones = :observaciones
                WHERE id_pedido = :id_pedido";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->bindParam(':id_mesa', $id_mesa);
        $consulta->bindParam(':id_usuario', $id_usuario);
        $consulta->bindParam(':id_estado', $id_estado);
        $consulta->bindParam(':fecha_pedido', $fecha_pedido);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':descuento', $descuento);
        $consulta->bindParam(':total', $total);
        $consulta->bindParam(':observaciones', $observaciones);

        return $consulta->execute();
    }

    public function delete($id_pedido)
    {
        $sql = "DELETE FROM pedido WHERE id_pedido = :id_pedido";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_pedido', $id_pedido);

        return $consulta->execute();
    }
}
?>
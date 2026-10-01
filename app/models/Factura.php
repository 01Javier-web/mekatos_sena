<?php

require_once __DIR__ . '/../../config/database.php';

class Factura
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM factura";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_factura)
    {
        $sql = "SELECT * FROM factura WHERE id_factura = :id_factura";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_factura', $id_factura);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_pedido, $numero_factura, $fecha_emision, $subtotal, $descuento, $impuesto, $total, $estado)
    {
        $sql = "INSERT INTO factura
                (id_pedido, numero_factura, fecha_emision, subtotal, descuento, impuesto, total, estado)
                VALUES
                (:id_pedido, :numero_factura, :fecha_emision, :subtotal, :descuento, :impuesto, :total, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->bindParam(':numero_factura', $numero_factura);
        $consulta->bindParam(':fecha_emision', $fecha_emision);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':descuento', $descuento);
        $consulta->bindParam(':impuesto', $impuesto);
        $consulta->bindParam(':total', $total);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    public function update($id_factura, $id_pedido, $numero_factura, $fecha_emision, $subtotal, $descuento, $impuesto, $total, $estado)
    {
        $sql = "UPDATE factura
                SET id_pedido = :id_pedido,
                    numero_factura = :numero_factura,
                    fecha_emision = :fecha_emision,
                    subtotal = :subtotal,
                    descuento = :descuento,
                    impuesto = :impuesto,
                    total = :total,
                    estado = :estado
                WHERE id_factura = :id_factura";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_factura', $id_factura);
        $consulta->bindParam(':id_pedido', $id_pedido);
        $consulta->bindParam(':numero_factura', $numero_factura);
        $consulta->bindParam(':fecha_emision', $fecha_emision);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':descuento', $descuento);
        $consulta->bindParam(':impuesto', $impuesto);
        $consulta->bindParam(':total', $total);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    public function delete($id_factura)
    {
        $sql = "DELETE FROM factura WHERE id_factura = :id_factura";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_factura', $id_factura);

        return $consulta->execute();
    }
}
?>
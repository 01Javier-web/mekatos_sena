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
        $sql = "SELECT
                    f.id_factura,
                    f.id_pedido,
                    f.numero_factura,
                    f.fecha_emision,
                    f.subtotal,
                    f.descuento,
                    f.impuesto,
                    f.total,
                    f.estado
                FROM factura AS f
                ORDER BY f.id_factura DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(
        $id_pedido,
        $numero_factura,
        $fecha_emision,
        $subtotal,
        $descuento,
        $impuesto,
        $total,
        $estado
    ) {
        $sql = "INSERT INTO factura
                    (
                        id_pedido,
                        numero_factura,
                        fecha_emision,
                        subtotal,
                        descuento,
                        impuesto,
                        total,
                        estado
                    )
                VALUES
                    (
                        :id_pedido,
                        :numero_factura,
                        :fecha_emision,
                        :subtotal,
                        :descuento,
                        :impuesto,
                        :total,
                        :estado
                    )";

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
}
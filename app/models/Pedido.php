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
        $sql = "SELECT
                    p.id_pedido,
                    p.id_mesa,
                    m.numero AS mesa_numero,
                    p.id_usuario,
                    CONCAT(u.nombre, ' ', u.apellido) AS usuario_nombre,
                    p.id_estado,
                    e.nombre AS estado_nombre,
                    p.fecha_pedido,
                    p.subtotal,
                    p.descuento,
                    p.total,
                    p.observaciones
                FROM pedido AS p
                INNER JOIN mesa AS m
                    ON p.id_mesa = m.id_mesa
                INNER JOIN usuario AS u
                    ON p.id_usuario = u.id_usuario
                INNER JOIN estado_pedido AS e
                    ON p.id_estado = e.id_estado
                ORDER BY p.id_pedido DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(
        $id_mesa,
        $id_usuario,
        $id_estado,
        $fecha_pedido,
        $subtotal,
        $descuento,
        $total,
        $observaciones
    ) {
        $sql = "INSERT INTO pedido
                    (
                        id_mesa,
                        id_usuario,
                        id_estado,
                        fecha_pedido,
                        subtotal,
                        descuento,
                        total,
                        observaciones
                    )
                VALUES
                    (
                        :id_mesa,
                        :id_usuario,
                        :id_estado,
                        :fecha_pedido,
                        :subtotal,
                        :descuento,
                        :total,
                        :observaciones
                    )";

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
}
<?php

require_once __DIR__ . '/../../config/database.php';

class EstadoPedido
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
                    id_estado,
                    nombre
                FROM estado_pedido
                ORDER BY id_estado DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nombre)
    {
        $sql = "INSERT INTO estado_pedido
                    (nombre)
                VALUES
                    (:nombre)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':nombre', $nombre);

        return $consulta->execute();
    }
}
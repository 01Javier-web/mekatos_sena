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
        $sql = "SELECT * FROM estado_pedido";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_estado)
    {
        $sql = "SELECT * FROM estado_pedido WHERE id_estado = :id_estado";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_estado', $id_estado);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre)
    {
        $sql = "INSERT INTO estado_pedido (nombre)
                VALUES (:nombre)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);

        return $consulta->execute();
    }

    public function update($id_estado, $nombre)
    {
        $sql = "UPDATE estado_pedido
                SET nombre = :nombre
                WHERE id_estado = :id_estado";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_estado', $id_estado);
        $consulta->bindParam(':nombre', $nombre);

        return $consulta->execute();
    }

    public function delete($id_estado)
    {
        $sql = "DELETE FROM estado_pedido WHERE id_estado = :id_estado";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_estado', $id_estado);

        return $consulta->execute();
    }
}
?>
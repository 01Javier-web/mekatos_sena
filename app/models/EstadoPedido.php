
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
                ORDER BY id_estado ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id_estado,
                    nombre
                FROM estado_pedido
                WHERE id_estado = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre)
    {
        $sql = "INSERT INTO estado_pedido
                    (nombre)
                VALUES
                    (:nombre)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':nombre', $nombre);

        return $consulta->execute();
    }

    public function update($id, $nombre)
    {
        $sql = "UPDATE estado_pedido
                SET nombre = :nombre
                WHERE id_estado = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}

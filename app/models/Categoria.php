
<?php

require_once __DIR__ . '/../../config/database.php';

class Categoria
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
                    id_categoria,
                    nombre,
                    descripcion,
                    estado
                FROM categoria
                ORDER BY id_categoria ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id_categoria,
                    nombre,
                    descripcion,
                    estado
                FROM categoria
                WHERE id_categoria = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $descripcion, $estado)
    {
        $sql = "INSERT INTO categoria
                    (nombre, descripcion, estado)
                VALUES
                    (:nombre, :descripcion, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    public function update($id, $nombre, $descripcion, $estado)
    {
        $sql = "UPDATE categoria
                SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    estado = :estado
                WHERE id_categoria = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}

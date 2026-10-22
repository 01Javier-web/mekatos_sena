
<?php

require_once __DIR__ . '/../../config/database.php';

class Rol
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
                    id_rol,
                    nombre,
                    descripcion
                FROM rol
                ORDER BY id_rol ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id_rol,
                    nombre,
                    descripcion
                FROM rol
                WHERE id_rol = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $descripcion)
    {
        $sql = "INSERT INTO rol
                    (nombre, descripcion)
                VALUES
                    (:nombre, :descripcion)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);

        return $consulta->execute();
    }

    public function update($id, $nombre, $descripcion)
    {
        $sql = "UPDATE rol
                SET
                    nombre = :nombre,
                    descripcion = :descripcion
                WHERE id_rol = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}

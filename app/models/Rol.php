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
        $sql = "SELECT * FROM rol";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_rol)
    {
        $sql = "SELECT * FROM rol WHERE id_rol = :id_rol";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_rol', $id_rol);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $descripcion)
    {
        $sql = "INSERT INTO rol (nombre, descripcion)
                VALUES (:nombre, :descripcion)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);

        return $consulta->execute();
    }

    public function update($id_rol, $nombre, $descripcion)
    {
        $sql = "UPDATE rol
                SET nombre = :nombre,
                    descripcion = :descripcion
                WHERE id_rol = :id_rol";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_rol', $id_rol);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);

        return $consulta->execute();
    }

    public function delete($id_rol)
    {
        $sql = "DELETE FROM rol WHERE id_rol = :id_rol";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_rol', $id_rol);

        return $consulta->execute();
    }
}
?>
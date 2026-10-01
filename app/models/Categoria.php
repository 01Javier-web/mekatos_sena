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
                ORDER BY nombre ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_categoria)
    {
        $sql = "SELECT
                    id_categoria,
                    nombre,
                    descripcion,
                    estado
                FROM categoria
                WHERE id_categoria = :id_categoria";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
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

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    public function update($id_categoria, $nombre, $descripcion, $estado)
    {
        $sql = "UPDATE categoria
                SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    estado = :estado
                WHERE id_categoria = :id_categoria";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    public function delete($id_categoria)
    {
        $sql = "DELETE FROM categoria
                WHERE id_categoria = :id_categoria";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

        return $consulta->execute();
    }
}
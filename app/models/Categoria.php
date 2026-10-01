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
                ORDER BY id_categoria DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
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
}
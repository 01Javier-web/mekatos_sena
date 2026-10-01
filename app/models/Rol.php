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
                ORDER BY id_rol DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $descripcion)
    {
        $sql = "INSERT INTO rol
                    (nombre, descripcion)
                VALUES
                    (:nombre, :descripcion)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);

        return $consulta->execute();
    }
}
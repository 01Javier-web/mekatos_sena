<?php

require_once __DIR__ . '/../../config/database.php';

class Mesa
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
                    id_mesa,
                    numero,
                    capacidad,
                    estado
                FROM mesa
                ORDER BY id_mesa DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($numero, $capacidad, $estado)
    {
        $sql = "INSERT INTO mesa
                    (numero, capacidad, estado)
                VALUES
                    (:numero, :capacidad, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':numero', $numero);
        $consulta->bindParam(':capacidad', $capacidad);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }
}
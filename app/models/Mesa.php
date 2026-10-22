
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
                ORDER BY id_mesa ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id_mesa,
                    numero,
                    capacidad,
                    estado
                FROM mesa
                WHERE id_mesa = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($numero, $capacidad, $estado)
    {
        $sql = "INSERT INTO mesa
                    (numero, capacidad, estado)
                VALUES
                    (:numero, :capacidad, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':numero', $numero);
        $consulta->bindValue(':capacidad', $capacidad);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    public function update($id, $numero, $capacidad, $estado)
    {
        $sql = "UPDATE mesa
                SET
                    numero = :numero,
                    capacidad = :capacidad,
                    estado = :estado
                WHERE id_mesa = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':numero', $numero);
        $consulta->bindValue(':capacidad', $capacidad);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}

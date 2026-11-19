
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

    // Consultar todas las mesas.
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

    // Consultar una mesa por su ID.
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

    // Crear una mesa.
    public function crear($numero, $capacidad, $estado)
    {
        $sql = "INSERT INTO mesa
                    (numero, capacidad, estado)
                VALUES
                    (:numero, :capacidad, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':numero', $numero);
        $consulta->bindValue(':capacidad', $capacidad, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    // Actualizar una mesa.
    public function actualizar($id, $numero, $capacidad, $estado)
    {
        $sql = "UPDATE mesa
                SET
                    numero = :numero,
                    capacidad = :capacidad,
                    estado = :estado
                WHERE id_mesa = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':numero', $numero);
        $consulta->bindValue(':capacidad', $capacidad, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Eliminar una mesa si no tiene pedidos asociados.
    public function eliminar($id)
    {
        $sqlVerificar = "SELECT COUNT(*)
                         FROM pedido
                         WHERE id_mesa = :id";

        $consultaVerificar = $this->connection->prepare($sqlVerificar);
        $consultaVerificar->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaVerificar->execute();

        if ((int) $consultaVerificar->fetchColumn() > 0) {
            return false;
        }

        $sql = "DELETE FROM mesa
                WHERE id_mesa = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Compatibilidad temporal con el código anterior.
    public function create($numero, $capacidad, $estado)
    {
        return $this->crear($numero, $capacidad, $estado);
    }

    public function update($id, $numero, $capacidad, $estado)
    {
        return $this->actualizar($id, $numero, $capacidad, $estado);
    }
}

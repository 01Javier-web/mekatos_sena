
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

    // Consultar todos los estados.
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

    // Consultar un estado por su ID.
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

    // Crear un estado de pedido.
    public function crear($nombre)
    {
        $sql = "INSERT INTO estado_pedido
                    (nombre)
                VALUES
                    (:nombre)";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':nombre', $nombre);

        return $consulta->execute();
    }

    // Actualizar un estado de pedido.
    public function actualizar($id, $nombre)
    {
        $sql = "UPDATE estado_pedido
                SET nombre = :nombre
                WHERE id_estado = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Eliminar un estado si no tiene pedidos asociados.
    public function eliminar($id)
    {
        $sqlVerificar = "SELECT COUNT(*)
                         FROM pedido
                         WHERE id_estado = :id";

        $consultaVerificar = $this->connection->prepare($sqlVerificar);
        $consultaVerificar->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaVerificar->execute();

        if ((int) $consultaVerificar->fetchColumn() > 0) {
            return false;
        }

        $sql = "DELETE FROM estado_pedido
                WHERE id_estado = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Compatibilidad con los métodos anteriores.
    public function create($nombre)
    {
        return $this->crear($nombre);
    }

    public function update($id, $nombre)
    {
        return $this->actualizar($id, $nombre);
    }
}

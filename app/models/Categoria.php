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

    // Consultar todas las categorías.
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

    // Consultar una categoría por su ID.
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

    // Crear una categoría.
    public function crear($nombre, $descripcion, $estado)
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

    // Actualizar una categoría.
    public function actualizar($id, $nombre, $descripcion, $estado)
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

    // Eliminar una categoría si no tiene productos asociados.
    public function eliminar($id)
    {
        $sqlVerificar = "SELECT COUNT(*)
                         FROM producto
                         WHERE id_categoria = :id";

        $consultaVerificar = $this->connection->prepare($sqlVerificar);
        $consultaVerificar->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaVerificar->execute();

        if ((int) $consultaVerificar->fetchColumn() > 0) {
            return false;
        }

        $sql = "DELETE FROM categoria
                WHERE id_categoria = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    /*
     * Compatibilidad temporal con el controlador actual.
     * Estos métodos se retirarán cuando unifiquemos el controlador.
     */

    public function create($nombre, $descripcion, $estado)
    {
        return $this->crear($nombre, $descripcion, $estado);
    }

    public function update($id, $nombre, $descripcion, $estado)
    {
        return $this->actualizar($id, $nombre, $descripcion, $estado);
    }
}

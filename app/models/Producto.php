<?php

require_once __DIR__ . '/../../config/database.php';

class Producto
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
                    p.id_producto,
                    p.id_categoria,
                    c.nombre AS categoria_nombre,
                    p.nombre,
                    p.descripcion,
                    p.precio,
                    p.estado
                FROM producto AS p
                INNER JOIN categoria AS c
                    ON p.id_categoria = c.id_categoria
                ORDER BY p.id_producto DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($id_categoria, $nombre, $descripcion, $precio, $estado)
    {
        $sql = "INSERT INTO producto
                    (id_categoria, nombre, descripcion, precio, estado)
                VALUES
                    (:id_categoria, :nombre, :descripcion, :precio, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_categoria', $id_categoria);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':precio', $precio);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }
}
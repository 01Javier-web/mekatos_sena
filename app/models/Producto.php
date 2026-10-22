
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
                ORDER BY p.id_producto ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT *
                FROM producto
                WHERE id_producto = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create(
        $id_categoria,
        $nombre,
        $descripcion,
        $precio,
        $estado
    ) {
        $sql = "INSERT INTO producto
                    (
                        id_categoria,
                        nombre,
                        descripcion,
                        precio,
                        estado
                    )
                VALUES
                    (
                        :id_categoria,
                        :nombre,
                        :descripcion,
                        :precio,
                        :estado
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_categoria', $id_categoria);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':precio', $precio);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    public function update(
        $id,
        $id_categoria,
        $nombre,
        $descripcion,
        $precio,
        $estado
    ) {
        $sql = "UPDATE producto
                SET
                    id_categoria = :id_categoria,
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    estado = :estado
                WHERE id_producto = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_categoria', $id_categoria);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':precio', $precio);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}

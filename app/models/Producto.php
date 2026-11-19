
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

    // Consultar todos los productos.
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

    // Consultar un producto por su ID.
    public function getById($id)
    {
        $sql = "SELECT
                    id_producto,
                    id_categoria,
                    nombre,
                    descripcion,
                    precio,
                    estado
                FROM producto
                WHERE id_producto = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un producto.
    public function crear(
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

        $consulta->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':precio', $precio);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    // Actualizar un producto.
    public function actualizar(
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

        $consulta->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':descripcion', $descripcion);
        $consulta->bindValue(':precio', $precio);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Eliminar un producto si no tiene detalles de pedidos asociados.
    public function eliminar($id)
    {
        $sqlVerificar = "SELECT COUNT(*)
                         FROM detalle_pedido
                         WHERE id_producto = :id";

        $consultaVerificar = $this->connection->prepare($sqlVerificar);
        $consultaVerificar->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaVerificar->execute();

        if ((int) $consultaVerificar->fetchColumn() > 0) {
            return false;
        }

        $sql = "DELETE FROM producto
                WHERE id_producto = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Compatibilidad temporal con el código anterior.
    public function create(
        $id_categoria,
        $nombre,
        $descripcion,
        $precio,
        $estado
    ) {
        return $this->crear(
            $id_categoria,
            $nombre,
            $descripcion,
            $precio,
            $estado
        );
    }

    public function update(
        $id,
        $id_categoria,
        $nombre,
        $descripcion,
        $precio,
        $estado
    ) {
        return $this->actualizar(
            $id,
            $id_categoria,
            $nombre,
            $descripcion,
            $precio,
            $estado
        );
    }
}

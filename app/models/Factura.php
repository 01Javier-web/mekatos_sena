
<?php

require_once __DIR__ . '/../../config/database.php';

class Factura
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Consultar todas las facturas.
    public function getAll()
    {
        $sql = "SELECT
                    id_factura,
                    id_pedido,
                    numero_factura,
                    fecha_emision,
                    subtotal,
                    descuento,
                    impuesto,
                    total,
                    estado
                FROM factura
                ORDER BY id_factura ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar una factura por su ID.
    public function getById($id)
    {
        $sql = "SELECT
                    id_factura,
                    id_pedido,
                    numero_factura,
                    fecha_emision,
                    subtotal,
                    descuento,
                    impuesto,
                    total,
                    estado
                FROM factura
                WHERE id_factura = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una factura.
    public function crear(
        $id_pedido,
        $numero_factura,
        $fecha_emision,
        $subtotal,
        $descuento,
        $impuesto,
        $total,
        $estado
    ) {
        $sql = "INSERT INTO factura
                    (
                        id_pedido,
                        numero_factura,
                        fecha_emision,
                        subtotal,
                        descuento,
                        impuesto,
                        total,
                        estado
                    )
                VALUES
                    (
                        :id_pedido,
                        :numero_factura,
                        :fecha_emision,
                        :subtotal,
                        :descuento,
                        :impuesto,
                        :total,
                        :estado
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':numero_factura', $numero_factura);
        $consulta->bindValue(':fecha_emision', $fecha_emision);
        $consulta->bindValue(':subtotal', $subtotal);
        $consulta->bindValue(':descuento', $descuento);
        $consulta->bindValue(':impuesto', $impuesto);
        $consulta->bindValue(':total', $total);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    // Actualizar una factura.
    public function actualizar(
        $id,
        $id_pedido,
        $numero_factura,
        $fecha_emision,
        $subtotal,
        $descuento,
        $impuesto,
        $total,
        $estado
    ) {
        $sql = "UPDATE factura
                SET
                    id_pedido = :id_pedido,
                    numero_factura = :numero_factura,
                    fecha_emision = :fecha_emision,
                    subtotal = :subtotal,
                    descuento = :descuento,
                    impuesto = :impuesto,
                    total = :total,
                    estado = :estado
                WHERE id_factura = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':numero_factura', $numero_factura);
        $consulta->bindValue(':fecha_emision', $fecha_emision);
        $consulta->bindValue(':subtotal', $subtotal);
        $consulta->bindValue(':descuento', $descuento);
        $consulta->bindValue(':impuesto', $impuesto);
        $consulta->bindValue(':total', $total);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Eliminar una factura.
    public function eliminar($id)
    {
        $sql = "DELETE FROM factura
                WHERE id_factura = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Compatibilidad con el método anterior.
    public function create(
        $id_pedido,
        $numero_factura,
        $fecha_emision,
        $subtotal,
        $descuento,
        $impuesto,
        $total,
        $estado
    ) {
        return $this->crear(
            $id_pedido,
            $numero_factura,
            $fecha_emision,
            $subtotal,
            $descuento,
            $impuesto,
            $total,
            $estado
        );
    }
}


<?php

require_once __DIR__ . '/../../config/database.php';

class Pedido
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Consultar todos los pedidos.
    public function getAll()
    {
        $sql = "SELECT
                    p.id_pedido,
                    p.id_mesa,
                    m.numero AS mesa_numero,
                    p.id_usuario,
                    CONCAT(u.nombre, ' ', u.apellido) AS usuario_nombre,
                    p.id_estado,
                    e.nombre AS estado_nombre,
                    p.fecha_pedido,
                    p.subtotal,
                    p.descuento,
                    p.total,
                    p.observaciones
                FROM pedido AS p
                INNER JOIN mesa AS m
                    ON p.id_mesa = m.id_mesa
                INNER JOIN usuario AS u
                    ON p.id_usuario = u.id_usuario
                INNER JOIN estado_pedido AS e
                    ON p.id_estado = e.id_estado
                ORDER BY p.id_pedido ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar un pedido por su ID.
    public function getById($id)
    {
        $sql = "SELECT
                    id_pedido,
                    id_mesa,
                    id_usuario,
                    id_estado,
                    fecha_pedido,
                    subtotal,
                    descuento,
                    total,
                    observaciones
                FROM pedido
                WHERE id_pedido = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un pedido.
    public function crear(
        $id_mesa,
        $id_usuario,
        $id_estado,
        $fecha_pedido,
        $subtotal,
        $descuento,
        $total,
        $observaciones
    ) {
        $sql = "INSERT INTO pedido
                    (
                        id_mesa,
                        id_usuario,
                        id_estado,
                        fecha_pedido,
                        subtotal,
                        descuento,
                        total,
                        observaciones
                    )
                VALUES
                    (
                        :id_mesa,
                        :id_usuario,
                        :id_estado,
                        :fecha_pedido,
                        :subtotal,
                        :descuento,
                        :total,
                        :observaciones
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':id_estado', $id_estado, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_pedido', $fecha_pedido);
        $consulta->bindValue(':subtotal', $subtotal);
        $consulta->bindValue(':descuento', $descuento);
        $consulta->bindValue(':total', $total);
        $consulta->bindValue(':observaciones', $observaciones);

        return $consulta->execute();
    }

    // Actualizar un pedido.
    public function actualizar(
        $id,
        $id_mesa,
        $id_usuario,
        $id_estado,
        $fecha_pedido,
        $subtotal,
        $descuento,
        $total,
        $observaciones
    ) {
        $sql = "UPDATE pedido
                SET
                    id_mesa = :id_mesa,
                    id_usuario = :id_usuario,
                    id_estado = :id_estado,
                    fecha_pedido = :fecha_pedido,
                    subtotal = :subtotal,
                    descuento = :descuento,
                    total = :total,
                    observaciones = :observaciones
                WHERE id_pedido = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':id_estado', $id_estado, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_pedido', $fecha_pedido);
        $consulta->bindValue(':subtotal', $subtotal);
        $consulta->bindValue(':descuento', $descuento);
        $consulta->bindValue(':total', $total);
        $consulta->bindValue(':observaciones', $observaciones);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Eliminar un pedido si no tiene registros asociados.
    public function eliminar($id)
    {
        // Verificar detalles del pedido.
        $sqlDetalles = "SELECT COUNT(*)
                        FROM detalle_pedido
                        WHERE id_pedido = :id";

        $consultaDetalles = $this->connection->prepare($sqlDetalles);
        $consultaDetalles->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaDetalles->execute();

        if ((int) $consultaDetalles->fetchColumn() > 0) {
            return false;
        }

        // Verificar facturas asociadas.
        $sqlFacturas = "SELECT COUNT(*)
                        FROM factura
                        WHERE id_pedido = :id";

        $consultaFacturas = $this->connection->prepare($sqlFacturas);
        $consultaFacturas->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaFacturas->execute();

        if ((int) $consultaFacturas->fetchColumn() > 0) {
            return false;
        }

        // Eliminar el pedido.
        $sql = "DELETE FROM pedido
                WHERE id_pedido = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Compatibilidad con los métodos anteriores.
    public function create(
        $id_mesa,
        $id_usuario,
        $id_estado,
        $fecha_pedido,
        $subtotal,
        $descuento,
        $total,
        $observaciones
    ) {
        return $this->crear(
            $id_mesa,
            $id_usuario,
            $id_estado,
            $fecha_pedido,
            $subtotal,
            $descuento,
            $total,
            $observaciones
        );
    }

    public function update(
        $id,
        $id_mesa,
        $id_usuario,
        $id_estado,
        $fecha_pedido,
        $subtotal,
        $descuento,
        $total,
        $observaciones
    ) {
        return $this->actualizar(
            $id,
            $id_mesa,
            $id_usuario,
            $id_estado,
            $fecha_pedido,
            $subtotal,
            $descuento,
            $total,
            $observaciones
        );
    }
}

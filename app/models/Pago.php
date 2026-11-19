
<?php

require_once __DIR__ . '/../../config/database.php';

class Pago
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    // Obtener todos los pagos
    public function getAll()
    {
        $sql = "SELECT
                    p.id_pago,
                    p.id_factura,
                    f.numero_factura,
                    p.id_metodo_pago,
                    m.nombre AS metodo_pago_nombre,
                    p.valor,
                    p.referencia,
                    p.fecha_pago,
                    p.estado
                FROM pago AS p
                INNER JOIN factura AS f
                    ON p.id_factura = f.id_factura
                INNER JOIN metodo_pago AS m
                    ON p.id_metodo_pago = m.id_metodo_pago
                ORDER BY p.id_pago ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un pago por su ID
    public function getById($id)
    {
        $sql = "SELECT
                    id_pago,
                    id_factura,
                    id_metodo_pago,
                    valor,
                    referencia,
                    fecha_pago,
                    estado
                FROM pago
                WHERE id_pago = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un pago
    public function crear(
        $id_factura,
        $id_metodo_pago,
        $valor,
        $referencia,
        $fecha_pago,
        $estado
    ) {
        $sql = "INSERT INTO pago (
                    id_factura,
                    id_metodo_pago,
                    valor,
                    referencia,
                    fecha_pago,
                    estado
                ) VALUES (
                    :id_factura,
                    :id_metodo_pago,
                    :valor,
                    :referencia,
                    :fecha_pago,
                    :estado
                )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_factura', $id_factura);
        $consulta->bindParam(':id_metodo_pago', $id_metodo_pago);
        $consulta->bindParam(':valor', $valor);
        $consulta->bindParam(':referencia', $referencia);
        $consulta->bindParam(':fecha_pago', $fecha_pago);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    // Actualizar un pago
    public function actualizar(
        $id,
        $id_factura,
        $id_metodo_pago,
        $valor,
        $referencia,
        $fecha_pago,
        $estado
    ) {
        $sql = "UPDATE pago SET
                    id_factura = :id_factura,
                    id_metodo_pago = :id_metodo_pago,
                    valor = :valor,
                    referencia = :referencia,
                    fecha_pago = :fecha_pago,
                    estado = :estado
                WHERE id_pago = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':id_factura', $id_factura);
        $consulta->bindParam(':id_metodo_pago', $id_metodo_pago);
        $consulta->bindParam(':valor', $valor);
        $consulta->bindParam(':referencia', $referencia);
        $consulta->bindParam(':fecha_pago', $fecha_pago);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    // Eliminar un pago
    public function eliminar($id)
    {
        $sql = "DELETE FROM pago WHERE id_pago = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    // Métodos de compatibilidad
    public function create(
        $id_factura,
        $id_metodo_pago,
        $valor,
        $referencia,
        $fecha_pago,
        $estado
    ) {
        return $this->crear(
            $id_factura,
            $id_metodo_pago,
            $valor,
            $referencia,
            $fecha_pago,
            $estado
        );
    }

    public function update(
        $id,
        $id_factura,
        $id_metodo_pago,
        $valor,
        $referencia,
        $fecha_pago,
        $estado
    ) {
        return $this->actualizar(
            $id,
            $id_factura,
            $id_metodo_pago,
            $valor,
            $referencia,
            $fecha_pago,
            $estado
        );
    }
}

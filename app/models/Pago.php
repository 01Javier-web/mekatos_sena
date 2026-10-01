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
                ORDER BY p.id_pago DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(
        $id_factura,
        $id_metodo_pago,
        $valor,
        $referencia,
        $fecha_pago,
        $estado
    ) {
        $sql = "INSERT INTO pago
                    (
                        id_factura,
                        id_metodo_pago,
                        valor,
                        referencia,
                        fecha_pago,
                        estado
                    )
                VALUES
                    (
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
}
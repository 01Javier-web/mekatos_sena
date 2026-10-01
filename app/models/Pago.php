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
        $sql = "SELECT * FROM pago";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_pago)
    {
        $sql = "SELECT * FROM pago WHERE id_pago = :id_pago";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_pago', $id_pago);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_factura, $id_metodo_pago, $valor, $referencia, $fecha_pago, $estado)
    {
        $sql = "INSERT INTO pago
                (id_factura, id_metodo_pago, valor, referencia, fecha_pago, estado)
                VALUES
                (:id_factura, :id_metodo_pago, :valor, :referencia, :fecha_pago, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_factura', $id_factura);
        $consulta->bindParam(':id_metodo_pago', $id_metodo_pago);
        $consulta->bindParam(':valor', $valor);
        $consulta->bindParam(':referencia', $referencia);
        $consulta->bindParam(':fecha_pago', $fecha_pago);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    public function update($id_pago, $id_factura, $id_metodo_pago, $valor, $referencia, $fecha_pago, $estado)
    {
        $sql = "UPDATE pago
                SET id_factura = :id_factura,
                    id_metodo_pago = :id_metodo_pago,
                    valor = :valor,
                    referencia = :referencia,
                    fecha_pago = :fecha_pago,
                    estado = :estado
                WHERE id_pago = :id_pago";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_pago', $id_pago);
        $consulta->bindParam(':id_factura', $id_factura);
        $consulta->bindParam(':id_metodo_pago', $id_metodo_pago);
        $consulta->bindParam(':valor', $valor);
        $consulta->bindParam(':referencia', $referencia);
        $consulta->bindParam(':fecha_pago', $fecha_pago);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }

    public function delete($id_pago)
    {
        $sql = "DELETE FROM pago WHERE id_pago = :id_pago";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id_pago', $id_pago);

        return $consulta->execute();
    }
}
?>
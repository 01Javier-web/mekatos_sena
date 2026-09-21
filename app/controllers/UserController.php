<?php

require_once __DIR__ . '/../../config/database.php';

class Mesa
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
                    id,
                    number,
                    name,
                    capacity,
                    qr_token,
                    status,
                    created_at,
                    updated_at
                FROM restaurant_tables
                ORDER BY number ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id,
                    number,
                    name,
                    capacity,
                    qr_token,
                    status
                FROM restaurant_tables
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($number, $name, $capacity, $qrToken)
    {
        $sql = "INSERT INTO restaurant_tables
                    (
                        number,
                        name,
                        capacity,
                        qr_token,
                        status,
                        created_at,
                        updated_at
                    )
                VALUES
                    (
                        :number,
                        :name,
                        :capacity,
                        :qr_token,
                        'AVAILABLE',
                        NOW(),
                        NOW()
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':number', $number, PDO::PARAM_INT);
        $consulta->bindParam(':name', $name);
        $consulta->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $consulta->bindParam(':qr_token', $qrToken);

        return $consulta->execute();
    }

    public function update($id, $number, $name, $capacity, $status)
    {
        $sql = "UPDATE restaurant_tables
                SET
                    number = :number,
                    name = :name,
                    capacity = :capacity,
                    status = :status,
                    updated_at = NOW()
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':number', $number, PDO::PARAM_INT);
        $consulta->bindParam(':name', $name);
        $consulta->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $consulta->bindParam(':status', $status);

        return $consulta->execute();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE restaurant_tables
                SET
                    status = :status,
                    updated_at = NOW()
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':status', $status);

        return $consulta->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM restaurant_tables WHERE id = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}
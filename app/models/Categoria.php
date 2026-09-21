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

    public function getAll()
    {
        $sql = "SELECT
                    id,
                    name,
                    description,
                    sort_order,
                    is_active,
                    created_at,
                    updated_at
                FROM categories
                ORDER BY sort_order ASC, name ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id,
                    name,
                    description,
                    sort_order,
                    is_active
                FROM categories
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $description, $sortOrder = 0)
    {
        $sql = "INSERT INTO categories
                    (name, description, sort_order, is_active, created_at, updated_at)
                VALUES
                    (:name, :description, :sort_order, 1, NOW(), NOW())";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':name', $name);
        $consulta->bindParam(':description', $description);
        $consulta->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);

        return $consulta->execute();
    }

    public function update($id, $name, $description, $sortOrder, $isActive)
    {
        $sql = "UPDATE categories
                SET
                    name = :name,
                    description = :description,
                    sort_order = :sort_order,
                    is_active = :is_active,
                    updated_at = NOW()
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':name', $name);
        $consulta->bindParam(':description', $description);
        $consulta->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $consulta->bindParam(':is_active', $isActive, PDO::PARAM_INT);

        return $consulta->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}
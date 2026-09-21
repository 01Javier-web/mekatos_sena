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
                    p.id,
                    p.name,
                    p.description,
                    p.price,
                    p.image_path,
                    p.is_available,
                    p.category_id,
                    c.name AS category_name
                FROM products AS p
                INNER JOIN categories AS c
                    ON p.category_id = c.id
                ORDER BY p.id DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.price,
                    p.image_path,
                    p.is_available,
                    p.category_id,
                    c.name AS category_name
                FROM products AS p
                INNER JOIN categories AS c
                    ON p.category_id = c.id
                WHERE p.id = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create(
        $categoryId,
        $name,
        $description,
        $price,
        $imagePath = null
    ) {
        $sql = "INSERT INTO products
                    (
                        category_id,
                        name,
                        description,
                        price,
                        image_path,
                        is_available,
                        created_at,
                        updated_at
                    )
                VALUES
                    (
                        :category_id,
                        :name,
                        :description,
                        :price,
                        :image_path,
                        1,
                        NOW(),
                        NOW()
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $consulta->bindParam(':name', $name);
        $consulta->bindParam(':description', $description);
        $consulta->bindParam(':price', $price);
        $consulta->bindParam(':image_path', $imagePath);

        return $consulta->execute();
    }

    public function update(
        $id,
        $categoryId,
        $name,
        $description,
        $price,
        $imagePath,
        $isAvailable
    ) {
        $sql = "UPDATE products
                SET
                    category_id = :category_id,
                    name = :name,
                    description = :description,
                    price = :price,
                    image_path = :image_path,
                    is_available = :is_available,
                    updated_at = NOW()
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $consulta->bindParam(':name', $name);
        $consulta->bindParam(':description', $description);
        $consulta->bindParam(':price', $price);
        $consulta->bindParam(':image_path', $imagePath);
        $consulta->bindParam(':is_available', $isAvailable, PDO::PARAM_INT);

        return $consulta->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }

    public function updateAvailability($id, $isAvailable)
    {
        $sql = "UPDATE products
                SET
                    is_available = :is_available,
                    updated_at = NOW()
                WHERE id = :id";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':is_available', $isAvailable, PDO::PARAM_INT);

        return $consulta->execute();
    }

    public function getByCategory($categoryId)
    {
        $sql = "SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.price,
                    p.image_path,
                    p.is_available,
                    p.category_id
                FROM products AS p
                WHERE p.category_id = :category_id
                ORDER BY p.name ASC";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
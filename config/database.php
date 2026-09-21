<?php

class Database
{
    private $host = 'localhost';
    private $port = '3306';
    private $database = 'mekatos';
    private $username = 'root';
    private $password = '';

    private ?PDO $connection = null;

    public function connect(): PDO
    {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";

                $this->connection = new PDO(
                    $dsn,
                    $this->username,
                    $this->password
                );

                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                $this->connection->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return $this->connection;
    }
}
<?php

require_once __DIR__ . '/../../config/database.php';

class User
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
                    u.id_usuario,
                    u.id_rol,
                    r.nombre AS rol_nombre,
                    u.nombre,
                    u.apellido,
                    u.correo,
                    u.telefono,
                    u.estado
                FROM usuario AS u
                INNER JOIN rol AS r
                    ON u.id_rol = r.id_rol
                ORDER BY u.id_usuario DESC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($id_rol, $nombre, $apellido, $correo, $telefono, $password, $estado)
    {
        $sql = "INSERT INTO usuario
                    (id_rol, nombre, apellido, correo, telefono, password, estado)
                VALUES
                    (:id_rol, :nombre, :apellido, :correo, :telefono, :password, :estado)";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindParam(':id_rol', $id_rol);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':correo', $correo);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':password', $password);
        $consulta->bindParam(':estado', $estado);

        return $consulta->execute();
    }
}
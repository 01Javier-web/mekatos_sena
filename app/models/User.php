
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
                ORDER BY u.id_usuario ASC";

        $consulta = $this->connection->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    id_usuario,
                    id_rol,
                    nombre,
                    apellido,
                    correo,
                    telefono,
                    estado
                FROM usuario
                WHERE id_usuario = :id
                LIMIT 1";

        $consulta = $this->connection->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function create(
        $id_rol,
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $password,
        $estado
    ) {
        $sql = "INSERT INTO usuario
                    (
                        id_rol,
                        nombre,
                        apellido,
                        correo,
                        telefono,
                        password,
                        estado
                    )
                VALUES
                    (
                        :id_rol,
                        :nombre,
                        :apellido,
                        :correo,
                        :telefono,
                        :password,
                        :estado
                    )";

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_rol', $id_rol, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':correo', $correo);
        $consulta->bindValue(':telefono', $telefono);
        $consulta->bindValue(':password', $password);
        $consulta->bindValue(':estado', $estado);

        return $consulta->execute();
    }

    public function update(
        $id,
        $id_rol,
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $password,
        $estado
    ) {
        if ($password === '') {
            $sql = "UPDATE usuario
                    SET
                        id_rol = :id_rol,
                        nombre = :nombre,
                        apellido = :apellido,
                        correo = :correo,
                        telefono = :telefono,
                        estado = :estado
                    WHERE id_usuario = :id";
        } else {
            $sql = "UPDATE usuario
                    SET
                        id_rol = :id_rol,
                        nombre = :nombre,
                        apellido = :apellido,
                        correo = :correo,
                        telefono = :telefono,
                        password = :password,
                        estado = :estado
                    WHERE id_usuario = :id";
        }

        $consulta = $this->connection->prepare($sql);

        $consulta->bindValue(':id_rol', $id_rol, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':correo', $correo);
        $consulta->bindValue(':telefono', $telefono);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        if ($password !== '') {
            $consulta->bindValue(':password', $password);
        }

        return $consulta->execute();
    }
}

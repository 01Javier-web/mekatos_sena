<?php

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $usuarios = $this->model->getAll();

        require_once __DIR__ . '/../views/User/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/User/create.php';
    }

    public function guardar()
    {
        $id_rol = $_POST['id_rol'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $password = $_POST['password'];
        $estado = $_POST['estado'];

        $resultado = $this->model->create(
            $id_rol,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $password,
            $estado
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar el usuario";
        }
    }
}
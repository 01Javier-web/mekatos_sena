<?php

require_once __DIR__ . '/../models/Rol.php';

class RolController
{
    private $model;

    public function __construct()
    {
        $this->model = new Rol();
    }

    public function index()
    {
        $roles = $this->model->getAll();

        require_once __DIR__ . '/../views/Rol/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Rol/create.php';
    }

    public function guardar()
    {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $resultado = $this->model->create(
            $nombre,
            $descripcion
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar el rol";
        }
    }
}
<?php

require_once __DIR__ . '/../Models/Rol.php';

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

        require_once __DIR__ . '/../Views/rol/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $this->model->create($nombre, $descripcion);

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../Views/rol/create.php';
    }

    public function show($id_rol)
    {
        $rol = $this->model->getById($id_rol);

        require_once __DIR__ . '/../Views/rol/show.php';
    }

    public function edit($id_rol)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $this->model->update(
                $id_rol,
                $nombre,
                $descripcion
            );

            header('Location: index.php');
            exit;
        }

        $rol = $this->model->getById($id_rol);

        require_once __DIR__ . '/../Views/rol/edit.php';
    }

    public function guardar()
{
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
}

    public function delete($id_rol)
    {
        $this->model->delete($id_rol);

        header('Location: index.php');
        exit;
    }
}
?>
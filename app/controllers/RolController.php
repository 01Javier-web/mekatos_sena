
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        if ($nombre === '') {
            echo 'El nombre del rol es obligatorio.';
            return;
        }

        $resultado = $this->model->create(
            $nombre,
            $descripcion
        );

        if ($resultado) {
            header('Location: ?controller=rol&action=index');
            exit;
        }

        echo 'Error al guardar el rol.';
    }

    public function edit()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del rol no es válido.';
            return;
        }

        $rol = $this->model->getById($id);

        if (!$rol) {
            echo 'No se encontró el rol solicitado.';
            return;
        }

        require_once __DIR__ . '/../views/Rol/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_rol'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        if (!$id || $id < 1) {
            echo 'El identificador del rol no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el rol que deseas actualizar.';
            return;
        }

        if ($nombre === '') {
            echo 'El nombre del rol es obligatorio.';
            return;
        }

        $resultado = $this->model->update(
            $id,
            $nombre,
            $descripcion
        );

        if ($resultado) {
            header('Location: ?controller=rol&action=index');
            exit;
        }

        echo 'Error al actualizar el rol.';
    }
}

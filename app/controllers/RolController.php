
<?php

require_once __DIR__ . '/../models/Rol.php';

class RolController
{
    private $model;

    public function __construct()
    {
        $this->model = new Rol();
    }

    // Mostrar todos los roles.
    public function index()
    {
        $roles = $this->model->getAll();

        require_once __DIR__ . '/../views/Rol/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        require_once __DIR__ . '/../views/Rol/create.php';
    }

    // Guardar un nuevo rol.
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

        $resultado = $this->model->crear(
            $nombre,
            $descripcion
        );

        if ($resultado) {
            header('Location: ?controller=rol&action=index');
            exit;
        }

        echo 'Error al guardar el rol.';
    }

    // Mostrar formulario de edición.
    public function editar()
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

        require_once __DIR__ . '/../views/Rol/editar.php';
    }

    // Actualizar un rol.
    public function actualizar()
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

        $resultado = $this->model->actualizar(
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

    // Eliminar un rol.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_rol'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del rol no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el rol que deseas eliminar.';
            return;
        }

        try {
            $resultado = $this->model->eliminar($id);

            if ($resultado) {
                header('Location: ?controller=rol&action=index');
                exit;
            }

            echo 'No se pudo eliminar el rol.';
        } catch (PDOException $e) {
            echo 'No se puede eliminar este rol porque tiene registros asociados.';
        }
    }

    // Compatibilidad con los nombres anteriores.
    public function create()
    {
        $this->crear();
    }

    public function edit()
    {
        $this->editar();
    }

    public function update()
    {
        $this->actualizar();
    }
}


<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Rol.php';

class UserController
{
    private $model;
    private $modeloRol;

    public function __construct()
    {
        $this->model = new User();
        $this->modeloRol = new Rol();
    }

    // Mostrar todos los usuarios.
    public function index()
    {
        $usuarios = $this->model->getAll();

        require_once __DIR__ . '/../views/User/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        $roles = $this->modeloRol->getAll();

        require_once __DIR__ . '/../views/User/create.php';
    }

    // Guardar un nuevo usuario.
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id_rol = filter_var(
            $_POST['id_rol'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $password = $_POST['password'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (
            !$id_rol ||
            !$this->modeloRol->getById($id_rol) ||
            $nombre === '' ||
            $apellido === '' ||
            !filter_var($correo, FILTER_VALIDATE_EMAIL) ||
            $password === '' ||
            !in_array($estado, ['Activo', 'Inactivo'], true)
        ) {
            echo 'Verifica los datos del usuario.';
            return;
        }

        $resultado = $this->model->crear(
            $id_rol,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $password,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=user&action=index');
            exit;
        }

        echo 'Error al guardar el usuario.';
    }

    // Mostrar formulario de edición.
    public function editar()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del usuario no es válido.';
            return;
        }

        $usuario = $this->model->getById($id);

        if (!$usuario) {
            echo 'No se encontró el usuario solicitado.';
            return;
        }

        $roles = $this->modeloRol->getAll();

        require_once __DIR__ . '/../views/User/editar.php';
    }

    // Actualizar un usuario.
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_usuario'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_rol = filter_var(
            $_POST['id_rol'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $password = $_POST['password'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (!$id || $id < 1) {
            echo 'El identificador del usuario no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el usuario que deseas actualizar.';
            return;
        }

        if (
            !$id_rol ||
            !$this->modeloRol->getById($id_rol) ||
            $nombre === '' ||
            $apellido === '' ||
            !filter_var($correo, FILTER_VALIDATE_EMAIL) ||
            !in_array($estado, ['Activo', 'Inactivo'], true)
        ) {
            echo 'Verifica los datos del usuario.';
            return;
        }

        $resultado = $this->model->actualizar(
            $id,
            $id_rol,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $password,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=user&action=index');
            exit;
        }

        echo 'Error al actualizar el usuario.';
    }

    // Eliminar un usuario.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_usuario'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del usuario no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el usuario que deseas eliminar.';
            return;
        }

        try {
            $resultado = $this->model->eliminar($id);

            if ($resultado) {
                header('Location: ?controller=user&action=index');
                exit;
            }

            echo 'No se pudo eliminar el usuario.';
        } catch (PDOException $e) {
            echo 'No se puede eliminar este usuario porque tiene registros asociados.';
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

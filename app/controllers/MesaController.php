
<?php

require_once __DIR__ . '/../models/Mesa.php';

class MesaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Mesa();
    }

    public function index()
    {
        $mesas = $this->model->getAll();

        require_once __DIR__ . '/../views/Mesa/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Mesa/create.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $numero = trim($_POST['numero'] ?? '');
        $capacidad = $_POST['capacidad'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (
            $numero === '' ||
            $capacidad === '' ||
            !is_numeric($capacidad) ||
            (int) $capacidad < 1 ||
            !in_array($estado, ['Disponible', 'Ocupada', 'Inactiva'], true)
        ) {
            echo 'Verifica los datos de la mesa.';
            return;
        }

        $resultado = $this->model->create(
            $numero,
            $capacidad,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=mesa&action=index');
            exit;
        }

        echo 'Error al guardar la mesa.';
    }

    public function edit()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador de la mesa no es válido.';
            return;
        }

        $mesa = $this->model->getById($id);

        if (!$mesa) {
            echo 'No se encontró la mesa solicitada.';
            return;
        }

        require_once __DIR__ . '/../views/Mesa/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_mesa'] ?? '',
            FILTER_VALIDATE_INT
        );

        $numero = trim($_POST['numero'] ?? '');
        $capacidad = $_POST['capacidad'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (!$id || $id < 1) {
            echo 'El identificador de la mesa no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró la mesa que deseas actualizar.';
            return;
        }

        if (
            $numero === '' ||
            $capacidad === '' ||
            !is_numeric($capacidad) ||
            (int) $capacidad < 1 ||
            !in_array($estado, ['Disponible', 'Ocupada', 'Inactiva'], true)
        ) {
            echo 'Verifica los datos de la mesa.';
            return;
        }

        $resultado = $this->model->update(
            $id,
            $numero,
            $capacidad,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=mesa&action=index');
            exit;
        }

        echo 'Error al actualizar la mesa.';
    }
}

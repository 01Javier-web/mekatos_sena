
<?php

require_once __DIR__ . '/../models/Mesa.php';

class MesaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Mesa();
    }

    // Mostrar todas las mesas.
    public function index()
    {
        $mesas = $this->model->getAll();

        require_once __DIR__ . '/../views/Mesa/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        require_once __DIR__ . '/../views/Mesa/create.php';
    }

    // Guardar una nueva mesa.
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $numero = trim($_POST['numero'] ?? '');
        $capacidad = $_POST['capacidad'] ?? '';
        $estado = $_POST['estado'] ?? '';

        $estadosPermitidos = [
            'Disponible',
            'Ocupada',
            'Reservada',
            'Fuera de servicio'
        ];

        if (
            $numero === '' ||
            $capacidad === '' ||
            !filter_var($capacidad, FILTER_VALIDATE_INT) ||
            (int) $capacidad < 1 ||
            !in_array($estado, $estadosPermitidos, true)
        ) {
            echo 'Verifica los datos de la mesa.';
            return;
        }

        $resultado = $this->model->crear(
            $numero,
            (int) $capacidad,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=mesa&action=index');
            exit;
        }

        echo 'Error al guardar la mesa.';
    }

    // Mostrar formulario de edición.
    public function editar()
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

        require_once __DIR__ . '/../views/Mesa/editar.php';
    }

    // Actualizar una mesa.
    public function actualizar()
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

        $estadosPermitidos = [
            'Disponible',
            'Ocupada',
            'Reservada',
            'Fuera de servicio'
        ];

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
            !filter_var($capacidad, FILTER_VALIDATE_INT) ||
            (int) $capacidad < 1 ||
            !in_array($estado, $estadosPermitidos, true)
        ) {
            echo 'Verifica los datos de la mesa.';
            return;
        }

        $resultado = $this->model->actualizar(
            $id,
            $numero,
            (int) $capacidad,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=mesa&action=index');
            exit;
        }

        echo 'Error al actualizar la mesa.';
    }

    // Eliminar una mesa.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_mesa'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador de la mesa no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró la mesa que deseas eliminar.';
            return;
        }

        $resultado = $this->model->eliminar($id);

        if ($resultado) {
            header('Location: ?controller=mesa&action=index');
            exit;
        }

        echo 'No se puede eliminar esta mesa porque tiene pedidos asociados.';
    }

    // Compatibilidad con las rutas anteriores.
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

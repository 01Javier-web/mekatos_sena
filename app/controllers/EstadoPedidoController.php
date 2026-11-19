
<?php

require_once __DIR__ . '/../models/EstadoPedido.php';

class EstadoPedidoController
{
    private $model;

    public function __construct()
    {
        $this->model = new EstadoPedido();
    }

    // Mostrar todos los estados.
    public function index()
    {
        $estados = $this->model->getAll();

        require_once __DIR__ . '/../views/EstadoPedido/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        require_once __DIR__ . '/../views/EstadoPedido/create.php';
    }

    // Guardar un nuevo estado.
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre === '') {
            echo 'El nombre del estado es obligatorio.';
            return;
        }

        $resultado = $this->model->crear($nombre);

        if ($resultado) {
            header('Location: ?controller=estado_pedido&action=index');
            exit;
        }

        echo 'Error al guardar el estado del pedido.';
    }

    // Mostrar formulario de edición.
    public function editar()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del estado no es válido.';
            return;
        }

        $estado = $this->model->getById($id);

        if (!$estado) {
            echo 'No se encontró el estado solicitado.';
            return;
        }

        require_once __DIR__ . '/../views/EstadoPedido/editar.php';
    }

    // Actualizar un estado.
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_estado'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');

        if (!$id || $id < 1) {
            echo 'El identificador del estado no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el estado que deseas actualizar.';
            return;
        }

        if ($nombre === '') {
            echo 'El nombre del estado es obligatorio.';
            return;
        }

        $resultado = $this->model->actualizar($id, $nombre);

        if ($resultado) {
            header('Location: ?controller=estado_pedido&action=index');
            exit;
        }

        echo 'Error al actualizar el estado del pedido.';
    }

    // Eliminar un estado.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_estado'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del estado no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el estado que deseas eliminar.';
            return;
        }

        try {
            $resultado = $this->model->eliminar($id);

            if ($resultado) {
                header('Location: ?controller=estado_pedido&action=index');
                exit;
            }

            echo 'No se puede eliminar este estado porque tiene pedidos asociados.';
        } catch (PDOException $e) {
            echo 'No se puede eliminar el estado porque tiene registros asociados.';
        }
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

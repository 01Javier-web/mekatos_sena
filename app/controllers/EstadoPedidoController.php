
<?php

require_once __DIR__ . '/../models/EstadoPedido.php';

class EstadoPedidoController
{
    private $model;

    public function __construct()
    {
        $this->model = new EstadoPedido();
    }

    public function index()
    {
        $estados = $this->model->getAll();

        require_once __DIR__ . '/../views/EstadoPedido/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/EstadoPedido/create.php';
    }

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

        $resultado = $this->model->create($nombre);

        if ($resultado) {
            header('Location: ?controller=estado_pedido&action=index');
            exit;
        }

        echo 'Error al guardar el estado del pedido.';
    }

    public function edit()
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

        require_once __DIR__ . '/../views/EstadoPedido/edit.php';
    }

    public function update()
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

        $resultado = $this->model->update($id, $nombre);

        if ($resultado) {
            header('Location: ?controller=estado_pedido&action=index');
            exit;
        }

        echo 'Error al actualizar el estado del pedido.';
    }
}

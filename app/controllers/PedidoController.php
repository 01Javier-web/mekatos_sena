
<?php

require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Mesa.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/EstadoPedido.php';

class PedidoController
{
    private $model;
    private $modeloMesa;
    private $modeloUsuario;
    private $modeloEstado;

    public function __construct()
    {
        $this->model = new Pedido();
        $this->modeloMesa = new Mesa();
        $this->modeloUsuario = new User();
        $this->modeloEstado = new EstadoPedido();
    }

    public function index()
    {
        $pedidos = $this->model->getAll();

        require_once __DIR__ . '/../views/Pedido/index.php';
    }

    public function create()
    {
        $mesas = $this->modeloMesa->getAll();
        $usuarios = $this->modeloUsuario->getAll();
        $estados = $this->modeloEstado->getAll();

        require_once __DIR__ . '/../views/Pedido/create.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id_mesa = filter_var($_POST['id_mesa'] ?? '', FILTER_VALIDATE_INT);
        $id_usuario = filter_var($_POST['id_usuario'] ?? '', FILTER_VALIDATE_INT);
        $id_estado = filter_var($_POST['id_estado'] ?? '', FILTER_VALIDATE_INT);

        $fecha_pedido = trim($_POST['fecha_pedido'] ?? '');
        $subtotal = $_POST['subtotal'] ?? '';
        $descuento = $_POST['descuento'] ?? '0';
        $total = $_POST['total'] ?? '';
        $observaciones = trim($_POST['observaciones'] ?? '');

        if (
            !$id_mesa ||
            !$this->modeloMesa->getById($id_mesa) ||
            !$id_usuario ||
            !$this->modeloUsuario->getById($id_usuario) ||
            !$id_estado ||
            !$this->modeloEstado->getById($id_estado) ||
            $fecha_pedido === '' ||
            !is_numeric($subtotal) ||
            (float) $subtotal < 0 ||
            !is_numeric($descuento) ||
            (float) $descuento < 0 ||
            !is_numeric($total) ||
            (float) $total < 0
        ) {
            echo 'Verifica los datos del pedido.';
            return;
        }

        $fecha_pedido = str_replace('T', ' ', $fecha_pedido);

        $resultado = $this->model->create(
            $id_mesa,
            $id_usuario,
            $id_estado,
            $fecha_pedido,
            $subtotal,
            $descuento,
            $total,
            $observaciones
        );

        if ($resultado) {
            header('Location: ?controller=pedido&action=index');
            exit;
        }

        echo 'Error al guardar el pedido.';
    }

    public function editar()
    {
        $id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            echo 'El identificador del pedido no es válido.';
            return;
        }

        $pedido = $this->model->getById($id);

        if (!$pedido) {
            echo 'No se encontró el pedido solicitado.';
            return;
        }

        $mesas = $this->modeloMesa->getAll();
        $usuarios = $this->modeloUsuario->getAll();
        $estados = $this->modeloEstado->getAll();

        require __DIR__ . '/../views/Pedido/editar.php';
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var($_POST['id_pedido'] ?? '', FILTER_VALIDATE_INT);
        $id_mesa = filter_var($_POST['id_mesa'] ?? '', FILTER_VALIDATE_INT);
        $id_usuario = filter_var($_POST['id_usuario'] ?? '', FILTER_VALIDATE_INT);
        $id_estado = filter_var($_POST['id_estado'] ?? '', FILTER_VALIDATE_INT);

        $fecha_pedido = trim($_POST['fecha_pedido'] ?? '');
        $subtotal = $_POST['subtotal'] ?? '';
        $descuento = $_POST['descuento'] ?? '0';
        $total = $_POST['total'] ?? '';
        $observaciones = trim($_POST['observaciones'] ?? '');

        if (!$id || $id < 1) {
            echo 'El identificador del pedido no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el pedido que deseas actualizar.';
            return;
        }

        if (
            !$id_mesa ||
            !$this->modeloMesa->getById($id_mesa) ||
            !$id_usuario ||
            !$this->modeloUsuario->getById($id_usuario) ||
            !$id_estado ||
            !$this->modeloEstado->getById($id_estado) ||
            $fecha_pedido === '' ||
            !is_numeric($subtotal) ||
            (float) $subtotal < 0 ||
            !is_numeric($descuento) ||
            (float) $descuento < 0 ||
            !is_numeric($total) ||
            (float) $total < 0
        ) {
            echo 'Verifica los datos del pedido.';
            return;
        }

        $fecha_pedido = str_replace('T', ' ', $fecha_pedido);

        $resultado = $this->model->update(
            $id,
            $id_mesa,
            $id_usuario,
            $id_estado,
            $fecha_pedido,
            $subtotal,
            $descuento,
            $total,
            $observaciones
        );

        if ($resultado) {
            header('Location: ?controller=pedido&action=index');
            exit;
        }

        echo 'Error al actualizar el pedido.';
    }
}

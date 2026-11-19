
<?php

require_once __DIR__ . '/../models/DetallePedido.php';
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Producto.php';

class DetallePedidoController
{
    private $model;
    private $modeloPedido;
    private $modeloProducto;

    public function __construct()
    {
        $this->model = new DetallePedido();
        $this->modeloPedido = new Pedido();
        $this->modeloProducto = new Producto();
    }

    // Mostrar todos los detalles.
    public function index()
    {
        $detalles = $this->model->getAll();

        require_once __DIR__ . '/../views/DetallePedido/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        $pedidos = $this->modeloPedido->getAll();
        $productos = $this->modeloProducto->getAll();

        require_once __DIR__ . '/../views/DetallePedido/create.php';
    }

    // Guardar un nuevo detalle.
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id_pedido = filter_var(
            $_POST['id_pedido'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_producto = filter_var(
            $_POST['id_producto'] ?? '',
            FILTER_VALIDATE_INT
        );

        $cantidad = $_POST['cantidad'] ?? '';
        $precio_unitario = $_POST['precio_unitario'] ?? '';
        $subtotal = $_POST['subtotal'] ?? '';
        $observacion = trim($_POST['observacion'] ?? '');

        if (
            !$id_pedido ||
            !$this->modeloPedido->getById($id_pedido) ||
            !$id_producto ||
            !$this->modeloProducto->getById($id_producto) ||
            !is_numeric($cantidad) ||
            (float) $cantidad <= 0 ||
            !is_numeric($precio_unitario) ||
            (float) $precio_unitario < 0 ||
            !is_numeric($subtotal) ||
            (float) $subtotal < 0
        ) {
            echo 'Verifica los datos del detalle de pedido.';
            return;
        }

        $resultado = $this->model->crear(
            $id_pedido,
            $id_producto,
            $cantidad,
            $precio_unitario,
            $subtotal,
            $observacion
        );

        if ($resultado) {
            header('Location: ?controller=detalle_pedido&action=index');
            exit;
        }

        echo 'Error al guardar el detalle de pedido.';
    }

    // Mostrar formulario de edición.
    public function editar()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del detalle no es válido.';
            return;
        }

        $detalle = $this->model->getById($id);

        if (!$detalle) {
            echo 'No se encontró el detalle solicitado.';
            return;
        }

        $pedidos = $this->modeloPedido->getAll();
        $productos = $this->modeloProducto->getAll();

        require_once __DIR__ . '/../views/DetallePedido/editar.php';
    }

    // Actualizar un detalle.
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_detalle'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_pedido = filter_var(
            $_POST['id_pedido'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_producto = filter_var(
            $_POST['id_producto'] ?? '',
            FILTER_VALIDATE_INT
        );

        $cantidad = $_POST['cantidad'] ?? '';
        $precio_unitario = $_POST['precio_unitario'] ?? '';
        $subtotal = $_POST['subtotal'] ?? '';
        $observacion = trim($_POST['observacion'] ?? '');

        if (!$id || $id < 1) {
            echo 'El identificador del detalle no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el detalle que deseas actualizar.';
            return;
        }

        if (
            !$id_pedido ||
            !$this->modeloPedido->getById($id_pedido) ||
            !$id_producto ||
            !$this->modeloProducto->getById($id_producto) ||
            !is_numeric($cantidad) ||
            (float) $cantidad <= 0 ||
            !is_numeric($precio_unitario) ||
            (float) $precio_unitario < 0 ||
            !is_numeric($subtotal) ||
            (float) $subtotal < 0
        ) {
            echo 'Verifica los datos del detalle de pedido.';
            return;
        }

        $resultado = $this->model->actualizar(
            $id,
            $id_pedido,
            $id_producto,
            $cantidad,
            $precio_unitario,
            $subtotal,
            $observacion
        );

        if ($resultado) {
            header('Location: ?controller=detalle_pedido&action=index');
            exit;
        }

        echo 'Error al actualizar el detalle de pedido.';
    }

    // Eliminar un detalle.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_detalle'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del detalle no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el detalle que deseas eliminar.';
            return;
        }

        try {
            $resultado = $this->model->eliminar($id);

            if ($resultado) {
                header('Location: ?controller=detalle_pedido&action=index');
                exit;
            }

            echo 'No se pudo eliminar el detalle de pedido.';
        } catch (PDOException $e) {
            echo 'No se puede eliminar el detalle porque tiene registros asociados.';
        }
    }

    // Compatibilidad con el nombre anterior.
    public function create()
    {
        $this->crear();
    }
}


<?php

require_once __DIR__ . '/../models/Factura.php';
require_once __DIR__ . '/../models/Pedido.php';

class FacturaController
{
    private $model;
    private $modeloPedido;

    public function __construct()
    {
        $this->model = new Factura();
        $this->modeloPedido = new Pedido();
    }

    // Mostrar todas las facturas.
    public function index()
    {
        $facturas = $this->model->getAll();

        require_once __DIR__ . '/../views/Factura/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        $pedidos = $this->modeloPedido->getAll();

        require_once __DIR__ . '/../views/Factura/create.php';
    }

    // Guardar una nueva factura.
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

        $numero_factura = trim($_POST['numero_factura'] ?? '');
        $fecha_emision = trim($_POST['fecha_emision'] ?? '');
        $subtotal = $_POST['subtotal'] ?? '';
        $descuento = $_POST['descuento'] ?? '0';
        $impuesto = $_POST['impuesto'] ?? '0';
        $total = $_POST['total'] ?? '';
        $estado = $_POST['estado'] ?? '';

        $estadosPermitidos = [
            'Pendiente',
            'Pagada',
            'Anulada'
        ];

        if (
            !$id_pedido ||
            !$this->modeloPedido->getById($id_pedido) ||
            $numero_factura === '' ||
            $fecha_emision === '' ||
            !is_numeric($subtotal) ||
            (float) $subtotal < 0 ||
            !is_numeric($descuento) ||
            (float) $descuento < 0 ||
            !is_numeric($impuesto) ||
            (float) $impuesto < 0 ||
            !is_numeric($total) ||
            (float) $total < 0 ||
            !in_array($estado, $estadosPermitidos, true)
        ) {
            echo 'Verifica los datos de la factura.';
            return;
        }

        $fecha_emision = str_replace('T', ' ', $fecha_emision);

        $resultado = $this->model->crear(
            $id_pedido,
            $numero_factura,
            $fecha_emision,
            $subtotal,
            $descuento,
            $impuesto,
            $total,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=factura&action=index');
            exit;
        }

        echo 'Error al guardar la factura.';
    }

    // Mostrar formulario de edición.
    public function editar()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador de la factura no es válido.';
            return;
        }

        $factura = $this->model->getById($id);

        if (!$factura) {
            echo 'No se encontró la factura solicitada.';
            return;
        }

        $pedidos = $this->modeloPedido->getAll();

        require_once __DIR__ . '/../views/Factura/editar.php';
    }

    // Actualizar una factura.
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_factura'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_pedido = filter_var(
            $_POST['id_pedido'] ?? '',
            FILTER_VALIDATE_INT
        );

        $numero_factura = trim($_POST['numero_factura'] ?? '');
        $fecha_emision = trim($_POST['fecha_emision'] ?? '');
        $subtotal = $_POST['subtotal'] ?? '';
        $descuento = $_POST['descuento'] ?? '0';
        $impuesto = $_POST['impuesto'] ?? '0';
        $total = $_POST['total'] ?? '';
        $estado = $_POST['estado'] ?? '';

        $estadosPermitidos = [
            'Pendiente',
            'Pagada',
            'Anulada'
        ];

        if (!$id || $id < 1) {
            echo 'El identificador de la factura no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró la factura que deseas actualizar.';
            return;
        }

        if (
            !$id_pedido ||
            !$this->modeloPedido->getById($id_pedido) ||
            $numero_factura === '' ||
            $fecha_emision === '' ||
            !is_numeric($subtotal) ||
            (float) $subtotal < 0 ||
            !is_numeric($descuento) ||
            (float) $descuento < 0 ||
            !is_numeric($impuesto) ||
            (float) $impuesto < 0 ||
            !is_numeric($total) ||
            (float) $total < 0 ||
            !in_array($estado, $estadosPermitidos, true)
        ) {
            echo 'Verifica los datos de la factura.';
            return;
        }

        $fecha_emision = str_replace('T', ' ', $fecha_emision);

        $resultado = $this->model->actualizar(
            $id,
            $id_pedido,
            $numero_factura,
            $fecha_emision,
            $subtotal,
            $descuento,
            $impuesto,
            $total,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=factura&action=index');
            exit;
        }

        echo 'Error al actualizar la factura.';
    }

    // Eliminar una factura.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_factura'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador de la factura no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró la factura que deseas eliminar.';
            return;
        }

        try {
            $resultado = $this->model->eliminar($id);

            if ($resultado) {
                header('Location: ?controller=factura&action=index');
                exit;
            }

            echo 'No se pudo eliminar la factura.';
        } catch (PDOException $e) {
            echo 'No se puede eliminar esta factura porque tiene pagos asociados.';
        }
    }

    // Compatibilidad con la ruta anterior.
    public function create()
    {
        $this->crear();
    }
}

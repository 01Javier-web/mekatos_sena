
<?php

require_once __DIR__ . '/../models/Pago.php';
require_once __DIR__ . '/../models/Factura.php';
require_once __DIR__ . '/../../config/database.php';

class PagoController
{
    private $model;
    private $modeloFactura;
    private $connection;

    public function __construct()
    {
        $this->model = new Pago();
        $this->modeloFactura = new Factura();

        $database = new Database();
        $this->connection = $database->connect();
    }

    // Listar pagos
    public function index()
    {
        $pagos = $this->model->getAll();

        require_once __DIR__ . '/../views/Pago/index.php';
    }

    // Mostrar formulario de creación
    public function crear()
    {
        $facturas = $this->modeloFactura->getAll();

        $consulta = $this->connection->query(
            "SELECT id_metodo_pago, nombre
             FROM metodo_pago
             ORDER BY id_metodo_pago ASC"
        );

        $metodosPago = $consulta->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/Pago/create.php';
    }

    // Guardar pago
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id_factura = filter_var(
            $_POST['id_factura'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_metodo_pago = filter_var(
            $_POST['id_metodo_pago'] ?? '',
            FILTER_VALIDATE_INT
        );

        $valor = $_POST['valor'] ?? '';
        $referencia = trim($_POST['referencia'] ?? '');
        $fecha_pago = trim($_POST['fecha_pago'] ?? '');
        $estado = trim($_POST['estado'] ?? '');

        $estadosPermitidos = [
            'Pendiente',
            'Completado',
            'Cancelado'
        ];

        if (
            !$id_factura ||
            !$this->modeloFactura->getById($id_factura) ||
            !$id_metodo_pago ||
            !$this->existeMetodoPago($id_metodo_pago) ||
            !is_numeric($valor) ||
            (float) $valor < 0 ||
            $fecha_pago === '' ||
            !in_array($estado, $estadosPermitidos, true)
        ) {
            echo 'Verifica los datos del pago.';
            return;
        }

        $fecha_pago = str_replace('T', ' ', $fecha_pago);

        $resultado = $this->model->crear(
            $id_factura,
            $id_metodo_pago,
            $valor,
            $referencia,
            $fecha_pago,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=pago&action=index');
            exit;
        }

        echo 'Error al guardar el pago.';
    }

    // Mostrar formulario de edición
    public function editar()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del pago no es válido.';
            return;
        }

        $pago = $this->model->getById($id);

        if (!$pago) {
            echo 'No se encontró el pago solicitado.';
            return;
        }

        $facturas = $this->modeloFactura->getAll();

        $consulta = $this->connection->query(
            "SELECT id_metodo_pago, nombre
             FROM metodo_pago
             ORDER BY id_metodo_pago ASC"
        );

        $metodosPago = $consulta->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/Pago/editar.php';
    }

    // Actualizar pago
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_pago'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1 || !$this->model->getById($id)) {
            echo 'El pago que deseas actualizar no existe.';
            return;
        }

        $id_factura = filter_var(
            $_POST['id_factura'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_metodo_pago = filter_var(
            $_POST['id_metodo_pago'] ?? '',
            FILTER_VALIDATE_INT
        );

        $valor = $_POST['valor'] ?? '';
        $referencia = trim($_POST['referencia'] ?? '');
        $fecha_pago = trim($_POST['fecha_pago'] ?? '');
        $estado = trim($_POST['estado'] ?? '');

        $estadosPermitidos = [
            'Pendiente',
            'Completado',
            'Cancelado'
        ];

        if (
            !$id_factura ||
            !$this->modeloFactura->getById($id_factura) ||
            !$id_metodo_pago ||
            !$this->existeMetodoPago($id_metodo_pago) ||
            !is_numeric($valor) ||
            (float) $valor < 0 ||
            $fecha_pago === '' ||
            !in_array($estado, $estadosPermitidos, true)
        ) {
            echo 'Verifica los datos del pago.';
            return;
        }

        $fecha_pago = str_replace('T', ' ', $fecha_pago);

        $resultado = $this->model->actualizar(
            $id,
            $id_factura,
            $id_metodo_pago,
            $valor,
            $referencia,
            $fecha_pago,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=pago&action=index');
            exit;
        }

        echo 'Error al actualizar el pago.';
    }

    // Eliminar pago
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_pago'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1 || !$this->model->getById($id)) {
            echo 'El pago que deseas eliminar no existe.';
            return;
        }

        try {
            $resultado = $this->model->eliminar($id);

            if ($resultado) {
                header('Location: ?controller=pago&action=index');
                exit;
            }

            echo 'No se pudo eliminar el pago.';

        } catch (PDOException $e) {
            echo 'No se puede eliminar el pago porque tiene registros relacionados.';
        }
    }

    // Comprobar que exista el método de pago
    private function existeMetodoPago($id)
    {
        $consulta = $this->connection->prepare(
            "SELECT COUNT(*)
             FROM metodo_pago
             WHERE id_metodo_pago = :id"
        );

        $consulta->execute([':id' => $id]);

        return (int) $consulta->fetchColumn() > 0;
    }

    // Compatibilidad con la ruta anterior
    public function create()
    {
        $this->crear();
    }
}

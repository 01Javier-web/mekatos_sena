<?php

require_once __DIR__ . '/../Models/Pago.php';

class PagoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Pago();
    }

    public function index()
    {
        $pagos = $this->model->getAll();

        require_once __DIR__ . '/../Views/pago/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_factura = $_POST['id_factura'];
            $id_metodo_pago = $_POST['id_metodo_pago'];
            $valor = $_POST['valor'];
            $referencia = $_POST['referencia'];
            $fecha_pago = $_POST['fecha_pago'];
            $estado = $_POST['estado'];

            $this->model->create(
                $id_factura,
                $id_metodo_pago,
                $valor,
                $referencia,
                $fecha_pago,
                $estado
            );

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../Views/pago/create.php';
    }

    public function show($id_pago)
    {
        $pago = $this->model->getById($id_pago);

        require_once __DIR__ . '/../Views/pago/show.php';
    }

    public function edit($id_pago)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_factura = $_POST['id_factura'];
            $id_metodo_pago = $_POST['id_metodo_pago'];
            $valor = $_POST['valor'];
            $referencia = $_POST['referencia'];
            $fecha_pago = $_POST['fecha_pago'];
            $estado = $_POST['estado'];

            $this->model->update(
                $id_pago,
                $id_factura,
                $id_metodo_pago,
                $valor,
                $referencia,
                $fecha_pago,
                $estado
            );

            header('Location: index.php');
            exit;
        }

        $pago = $this->model->getById($id_pago);

        require_once __DIR__ . '/../Views/pago/edit.php';
    }

    public function guardar()
{
    $id_factura = $_POST['id_factura'];
    $id_metodo_pago = $_POST['id_metodo_pago'];
    $valor = $_POST['valor'];
    $referencia = $_POST['referencia'];
    $fecha_pago = $_POST['fecha_pago'];
    $estado = $_POST['estado'];
}

    public function delete($id_pago)
    {
        $this->model->delete($id_pago);

        header('Location: index.php');
        exit;
    }
}
?>
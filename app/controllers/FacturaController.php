<?php

require_once __DIR__ . '/../Models/Factura.php';

class FacturaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Factura();
    }

    public function index()
    {
        $facturas = $this->model->getAll();

        require_once __DIR__ . '/../Views/factura/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_pedido = $_POST['id_pedido'];
            $numero_factura = $_POST['numero_factura'];
            $fecha_emision = $_POST['fecha_emision'];
            $subtotal = $_POST['subtotal'];
            $descuento = $_POST['descuento'];
            $impuesto = $_POST['impuesto'];
            $total = $_POST['total'];
            $estado = $_POST['estado'];

            $this->model->create(
                $id_pedido,
                $numero_factura,
                $fecha_emision,
                $subtotal,
                $descuento,
                $impuesto,
                $total,
                $estado
            );

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../Views/factura/create.php';
    }

    public function show($id_factura)
    {
        $factura = $this->model->getById($id_factura);

        require_once __DIR__ . '/../Views/factura/show.php';
    }

    public function guardar()
{
    $id_pedido = $_POST['id_pedido'];
    $numero_factura = $_POST['numero_factura'];
    $fecha_emision = $_POST['fecha_emision'];
    $subtotal = $_POST['subtotal'];
    $descuento = $_POST['descuento'];
    $impuesto = $_POST['impuesto'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];
}

    public function edit($id_factura)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_pedido = $_POST['id_pedido'];
            $numero_factura = $_POST['numero_factura'];
            $fecha_emision = $_POST['fecha_emision'];
            $subtotal = $_POST['subtotal'];
            $descuento = $_POST['descuento'];
            $impuesto = $_POST['impuesto'];
            $total = $_POST['total'];
            $estado = $_POST['estado'];

            $this->model->update(
                $id_factura,
                $id_pedido,
                $numero_factura,
                $fecha_emision,
                $subtotal,
                $descuento,
                $impuesto,
                $total,
                $estado
            );

            header('Location: index.php');
            exit;
        }

        $factura = $this->model->getById($id_factura);

        require_once __DIR__ . '/../Views/factura/edit.php';
    }

    public function delete($id_factura)
    {
        $this->model->delete($id_factura);

        header('Location: index.php');
        exit;
    }
}
?>
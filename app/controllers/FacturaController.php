<?php

require_once __DIR__ . '/../models/Factura.php';

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

        require_once __DIR__ . '/../views/Factura/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Factura/create.php';
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

        $resultado = $this->model->create(
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
            $this->index();
        } else {
            echo "Error al guardar la factura";
        }
    }
}
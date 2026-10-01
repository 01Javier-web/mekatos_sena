<?php

require_once __DIR__ . '/../models/DetallePedido.php';

class DetallePedidoController
{
    private $model;

    public function __construct()
    {
        $this->model = new DetallePedido();
    }

    public function index()
    {
        $detalles = $this->model->getAll();

        require_once __DIR__ . '/../views/DetallePedido/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/DetallePedido/create.php';
    }

    public function guardar()
    {
        $id_pedido = $_POST['id_pedido'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
        $precio_unitario = $_POST['precio_unitario'];
        $subtotal = $_POST['subtotal'];
        $observacion = $_POST['observacion'];

        $resultado = $this->model->create(
            $id_pedido,
            $id_producto,
            $cantidad,
            $precio_unitario,
            $subtotal,
            $observacion
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar el detalle del pedido";
        }
    }
}
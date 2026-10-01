<?php

require_once __DIR__ . '/../models/Pedido.php';

class PedidoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Pedido();
    }

    public function index()
    {
        $pedidos = $this->model->getAll();

        require_once __DIR__ . '/../views/Pedido/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Pedido/create.php';
    }

    public function guardar()
    {
        $id_mesa = $_POST['id_mesa'];
        $id_usuario = $_POST['id_usuario'];
        $id_estado = $_POST['id_estado'];
        $fecha_pedido = $_POST['fecha_pedido'];
        $subtotal = $_POST['subtotal'];
        $descuento = $_POST['descuento'];
        $total = $_POST['total'];
        $observaciones = $_POST['observaciones'];

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
            $this->index();
        } else {
            echo "Error al guardar el pedido";
        }
    }
}
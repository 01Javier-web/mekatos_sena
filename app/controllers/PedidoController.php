<?php

require_once __DIR__ . '/../Models/Pedido.php';

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

        require_once __DIR__ . '/../Views/pedido/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_mesa = $_POST['id_mesa'];
            $id_usuario = $_POST['id_usuario'];
            $id_estado = $_POST['id_estado'];
            $fecha_pedido = $_POST['fecha_pedido'];
            $subtotal = $_POST['subtotal'];
            $descuento = $_POST['descuento'];
            $total = $_POST['total'];
            $observaciones = $_POST['observaciones'];

            $this->model->create(
                $id_mesa,
                $id_usuario,
                $id_estado,
                $fecha_pedido,
                $subtotal,
                $descuento,
                $total,
                $observaciones
            );

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../Views/pedido/create.php';
    }

    public function show($id_pedido)
    {
        $pedido = $this->model->getById($id_pedido);

        require_once __DIR__ . '/../Views/pedido/show.php';
    }

    public function edit($id_pedido)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_mesa = $_POST['id_mesa'];
            $id_usuario = $_POST['id_usuario'];
            $id_estado = $_POST['id_estado'];
            $fecha_pedido = $_POST['fecha_pedido'];
            $subtotal = $_POST['subtotal'];
            $descuento = $_POST['descuento'];
            $total = $_POST['total'];
            $observaciones = $_POST['observaciones'];

            $this->model->update(
                $id_pedido,
                $id_mesa,
                $id_usuario,
                $id_estado,
                $fecha_pedido,
                $subtotal,
                $descuento,
                $total,
                $observaciones
            );

            header('Location: index.php');
            exit;
        }

        $pedido = $this->model->getById($id_pedido);

        require_once __DIR__ . '/../Views/pedido/edit.php';
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
}

    public function delete($id_pedido)
    {
        $this->model->delete($id_pedido);

        header('Location: index.php');
        exit;
    }
}
?>
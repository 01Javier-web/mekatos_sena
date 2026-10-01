<?php

require_once __DIR__ . '/../Models/DetallePedido.php';

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

        require_once __DIR__ . '/../Views/detalle_pedido/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];
            $subtotal = $_POST['subtotal'];
            $observacion = $_POST['observacion'];

            $this->model->create(
                $id_pedido,
                $id_producto,
                $cantidad,
                $precio_unitario,
                $subtotal,
                $observacion
            );

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../Views/detalle_pedido/create.php';
    }

    public function show($id_detalle)
    {
        $detalle = $this->model->getById($id_detalle);

        require_once __DIR__ . '/../Views/detalle_pedido/show.php';
    }

    public function edit($id_detalle)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];
            $subtotal = $_POST['subtotal'];
            $observacion = $_POST['observacion'];

            $this->model->update(
                $id_detalle,
                $id_pedido,
                $id_producto,
                $cantidad,
                $precio_unitario,
                $subtotal,
                $observacion
            );

            header('Location: index.php');
            exit;
        }

        $detalle = $this->model->getById($id_detalle);

        require_once __DIR__ . '/../Views/detalle_pedido/edit.php';
    }

    public function guardar()
{
    $id_pedido = $_POST['id_pedido'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $subtotal = $_POST['subtotal'];
    $observacion = $_POST['observacion'];
}

    public function delete($id_detalle)
    {
        $this->model->delete($id_detalle);

        header('Location: index.php');
        exit;
    }
}
?>
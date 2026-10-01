<?php

require_once __DIR__ . '/../Models/EstadoPedido.php';

class EstadoPedidoController
{
    private $model;

    public function __construct()
    {
        $this->model = new EstadoPedido();
    }

    public function index()
    {
        $estados = $this->model->getAll();

        require_once __DIR__ . '/../Views/estado_pedido/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = $_POST['nombre'];

            $this->model->create($nombre);

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../Views/estado_pedido/create.php';
    }

    public function show($id_estado)
    {
        $estado = $this->model->getById($id_estado);

        require_once __DIR__ . '/../Views/estado_pedido/show.php';
    }

    public function edit($id_estado)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = $_POST['nombre'];

            $this->model->update(
                $id_estado,
                $nombre
            );

            header('Location: index.php');
            exit;
        }

        $estado = $this->model->getById($id_estado);

        require_once __DIR__ . '/../Views/estado_pedido/edit.php';
    }

    public function guardar()
{
    $nombre = $_POST['nombre'];
}

    public function delete($id_estado)
    {
        $this->model->delete($id_estado);

        header('Location: index.php');
        exit;
    }
}
?>
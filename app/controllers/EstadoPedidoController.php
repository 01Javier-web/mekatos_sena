<?php

require_once __DIR__ . '/../models/EstadoPedido.php';

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

        require_once __DIR__ . '/../views/EstadoPedido/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/EstadoPedido/create.php';
    }

    public function guardar()
    {
        $nombre = $_POST['nombre'];

        $resultado = $this->model->create($nombre);

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar el estado";
        }
    }
}
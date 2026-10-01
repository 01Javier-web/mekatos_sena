<?php

require_once __DIR__ . '/../models/Mesa.php';

class MesaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Mesa();
    }

    public function index()
    {
        $mesas = $this->model->getAll();

        require_once __DIR__ . '/../views/Mesa/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Mesa/create.php';
    }

    public function guardar()
    {
        $numero = $_POST['numero'];
        $capacidad = $_POST['capacidad'];
        $estado = $_POST['estado'];

        $resultado = $this->model->create(
            $numero,
            $capacidad,
            $estado
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar la mesa";
        }
    }
}
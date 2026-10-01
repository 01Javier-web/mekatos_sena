<?php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Categoria();
    }

    public function index()
    {
        $categorias = $this->model->getAll();

        require_once __DIR__ . '/../views/Categoria/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Categoria/create.php';
    }

    public function guardar()
    {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];

        $resultado = $this->model->create(
            $nombre,
            $descripcion,
            $estado
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar la categoría";
        }
    }
}
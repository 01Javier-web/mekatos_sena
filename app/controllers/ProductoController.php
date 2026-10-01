<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Producto();
    }

    public function index()
    {
        $productos = $this->model->getAll();

        require_once __DIR__ . '/../views/Producto/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Producto/create.php';
    }

    public function guardar()
    {
        $id_categoria = $_POST['id_categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $estado = $_POST['estado'];

        $resultado = $this->model->create(
            $id_categoria,
            $nombre,
            $descripcion,
            $precio,
            $estado
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar el producto";
        }
    }
}
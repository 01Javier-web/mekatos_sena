<?php

require_once __DIR__ . '/../Models/Categoria.php';

class CategoriaController
{
    public function index()
    {
        $categoria = new Categoria();

        $categorias = $categoria->getAll();

        require_once __DIR__ . '/../Views/categoria/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/categoria/create.php';
    }

    public function guardar()
    {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
    }
}
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

    public function show($id)
    {
        $categoria = new Categoria();

        $categoriaData = $categoria->getById($id);

        require_once __DIR__ . '/../Views/categoria/show.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/categoria/create.php';
    }

    public function store()
    {
        $categoria = new Categoria();

        $name = $_POST['name'];
        $description = $_POST['description'] ?? '';
        $sortOrder = $_POST['sort_order'] ?? 0;

        $categoria->create(
            $name,
            $description,
            $sortOrder
        );

        header('Location: /categorias');
        exit;
    }

    public function edit($id)
    {
        $categoria = new Categoria();

        $categoriaData = $categoria->getById($id);

        require_once __DIR__ . '/../Views/categoria/edit.php';
    }

    public function update($id)
    {
        $categoria = new Categoria();

        $name = $_POST['name'];
        $description = $_POST['description'] ?? '';
        $sortOrder = $_POST['sort_order'] ?? 0;
        $isActive = $_POST['is_active'] ?? 0;

        $categoria->update(
            $id,
            $name,
            $description,
            $sortOrder,
            $isActive
        );

        header('Location: /categorias');
        exit;
    }

    public function delete($id)
    {
        $categoria = new Categoria();

        $categoria->delete($id);

        header('Location: /categorias');
        exit;
    }
}
<?php

require_once __DIR__ . '/../Models/Producto.php';
require_once __DIR__ . '/../Models/Categoria.php';

class ProductoController
{
    public function index()
    {
        $producto = new Producto();

        $productos = $producto->getAll();

        require_once __DIR__ . '/../Views/producto/index.php';
    }

    public function show($id)
    {
        $producto = new Producto();

        $productoData = $producto->getById($id);

        require_once __DIR__ . '/../Views/producto/show.php';
    }

    public function create()
    {
        $categoria = new Categoria();

        $categorias = $categoria->getAll();

        require_once __DIR__ . '/../Views/producto/create.php';
    }

    public function store()
    {
        $producto = new Producto();

        $categoryId = $_POST['category_id'];
        $name = $_POST['name'];
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'];
        $imagePath = $_POST['image_path'] ?? null;

        $producto->create(
            $categoryId,
            $name,
            $description,
            $price,
            $imagePath
        );

        header('Location: /productos');
        exit;
    }

    public function edit($id)
    {
        $producto = new Producto();
        $categoria = new Categoria();

        $productoData = $producto->getById($id);
        $categorias = $categoria->getAll();

        require_once __DIR__ . '/../Views/producto/edit.php';
    }

    public function update($id)
    {
        $producto = new Producto();

        $categoryId = $_POST['category_id'];
        $name = $_POST['name'];
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'];
        $imagePath = $_POST['image_path'] ?? null;
        $isAvailable = $_POST['is_available'] ?? 0;

        $producto->update(
            $id,
            $categoryId,
            $name,
            $description,
            $price,
            $imagePath,
            $isAvailable
        );

        header('Location: /productos');
        exit;
    }

    public function toggleAvailability($id)
    {
        $producto = new Producto();

        $productoData = $producto->getById($id);

        if ($productoData) {
            $newStatus = $productoData['is_available'] ? 0 : 1;

            $producto->updateAvailability(
                $id,
                $newStatus
            );
        }

        header('Location: /productos');
        exit;
    }

    public function delete($id)
    {
        $producto = new Producto();

        $producto->delete($id);

        header('Location: /productos');
        exit;
    }
}
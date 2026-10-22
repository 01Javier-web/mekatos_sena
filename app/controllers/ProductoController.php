
<?php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';

class ProductoController
{
    private $model;
    private $modeloCategoria;

    public function __construct()
    {
        $this->model = new Producto();
        $this->modeloCategoria = new Categoria();
    }

    public function index()
    {
        $productos = $this->model->getAll();

        require_once __DIR__ . '/../views/Producto/index.php';
    }

    public function create()
    {
        $categorias = $this->modeloCategoria->getAll();

        require_once __DIR__ . '/../views/Producto/create.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id_categoria = $_POST['id_categoria'] ?? '';
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (
            $id_categoria === '' ||
            $nombre === '' ||
            $precio === '' ||
            !is_numeric($precio) ||
            (float) $precio < 0
        ) {
            echo 'Verifica los datos del producto.';
            return;
        }

        $resultado = $this->model->create(
            $id_categoria,
            $nombre,
            $descripcion,
            $precio,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=producto&action=index');
            exit;
        }

        echo 'Error al guardar el producto.';
    }

    public function edit()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del producto no es válido.';
            return;
        }

        $producto = $this->model->getById($id);

        if (!$producto) {
            echo 'No se encontró el producto solicitado.';
            return;
        }

        $categorias = $this->modeloCategoria->getAll();

        require_once __DIR__ . '/../views/Producto/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_producto'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_categoria = $_POST['id_categoria'] ?? '';
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (!$id || $id < 1) {
            echo 'El identificador del producto no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el producto que deseas actualizar.';
            return;
        }

        if (
            $id_categoria === '' ||
            $nombre === '' ||
            $precio === '' ||
            !is_numeric($precio) ||
            (float) $precio < 0
        ) {
            echo 'Verifica los datos del producto.';
            return;
        }

        $resultado = $this->model->update(
            $id,
            $id_categoria,
            $nombre,
            $descripcion,
            $precio,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=producto&action=index');
            exit;
        }

        echo 'Error al actualizar el producto.';
    }
}

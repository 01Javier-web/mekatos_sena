
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

    // Consultar todos los productos.
    public function index()
    {
        $productos = $this->model->getAll();

        require_once __DIR__ . '/../views/Producto/index.php';
    }

    // Mostrar formulario de creación.
    public function crear()
    {
        $categorias = $this->modeloCategoria->getAll();

        require_once __DIR__ . '/../views/Producto/create.php';
    }

    // Guardar un producto nuevo.
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id_categoria = filter_var(
            $_POST['id_categoria'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if (
            !$id_categoria ||
            !$this->modeloCategoria->getById($id_categoria) ||
            $nombre === '' ||
            $precio === '' ||
            !is_numeric($precio) ||
            (float) $precio < 0 ||
            !in_array($estado, ['Disponible', 'No disponible'], true)
        ) {
            echo 'Verifica los datos del producto.';
            return;
        }

        $resultado = $this->model->crear(
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

    // Mostrar formulario de edición.
    public function editar()
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

        require_once __DIR__ . '/../views/Producto/editar.php';
    }

    // Actualizar un producto existente.
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_producto'] ?? '',
            FILTER_VALIDATE_INT
        );

        $id_categoria = filter_var(
            $_POST['id_categoria'] ?? '',
            FILTER_VALIDATE_INT
        );

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
            !$id_categoria ||
            !$this->modeloCategoria->getById($id_categoria) ||
            $nombre === '' ||
            $precio === '' ||
            !is_numeric($precio) ||
            (float) $precio < 0 ||
            !in_array($estado, ['Disponible', 'No disponible'], true)
        ) {
            echo 'Verifica los datos del producto.';
            return;
        }

        $resultado = $this->model->actualizar(
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

    // Eliminar un producto.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_producto'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador del producto no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró el producto que deseas eliminar.';
            return;
        }

        $resultado = $this->model->eliminar($id);

        if ($resultado) {
            header('Location: ?controller=producto&action=index');
            exit;
        }

        echo 'No se puede eliminar este producto porque tiene detalles de pedidos asociados.';
    }

    // Compatibilidad temporal con enlaces anteriores.
    public function create()
    {
        $this->crear();
    }

    public function edit()
    {
        $this->editar();
    }

    public function update()
    {
        $this->actualizar();
    }
}

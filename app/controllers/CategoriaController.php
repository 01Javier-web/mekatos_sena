<?php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Categoria();
    }

    // Consultar todas las categorías.
    public function index()
    {
        $categorias = $this->model->getAll();

        require_once __DIR__ . '/../views/Categoria/index.php';
    }

    // Mostrar formulario para crear una categoría.
    public function crear()
    {
        require_once __DIR__ . '/../views/Categoria/create.php';
    }

    // Guardar una nueva categoría.
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $estado = $_POST['estado'] ?? '';

        if (
            $nombre === '' ||
            !in_array($estado, ['Activo', 'Inactivo'], true)
        ) {
            echo 'Verifica los datos de la categoría.';
            return;
        }

        $resultado = $this->model->crear(
            $nombre,
            $descripcion,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=categoria&action=index');
            exit;
        }

        echo 'Error al guardar la categoría.';
    }

    // Mostrar formulario para editar una categoría.
    public function editar()
    {
        $id = filter_var(
            $_GET['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador de la categoría no es válido.';
            return;
        }

        $categoria = $this->model->getById($id);

        if (!$categoria) {
            echo 'No se encontró la categoría solicitada.';
            return;
        }

        require_once __DIR__ . '/../views/Categoria/editar.php';
    }

    // Actualizar una categoría existente.
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_categoria'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $estado = $_POST['estado'] ?? '';

        if (!$id || $id < 1) {
            echo 'El identificador de la categoría no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró la categoría que deseas actualizar.';
            return;
        }

        if (
            $nombre === '' ||
            !in_array($estado, ['Activo', 'Inactivo'], true)
        ) {
            echo 'Verifica los datos de la categoría.';
            return;
        }

        $resultado = $this->model->actualizar(
            $id,
            $nombre,
            $descripcion,
            $estado
        );

        if ($resultado) {
            header('Location: ?controller=categoria&action=index');
            exit;
        }

        echo 'Error al actualizar la categoría.';
    }

    // Eliminar una categoría.
    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $id = filter_var(
            $_POST['id_categoria'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            echo 'El identificador de la categoría no es válido.';
            return;
        }

        if (!$this->model->getById($id)) {
            echo 'No se encontró la categoría que deseas eliminar.';
            return;
        }

        $resultado = $this->model->eliminar($id);

        if ($resultado) {
            header('Location: ?controller=categoria&action=index');
            exit;
        }

        echo 'No se puede eliminar esta categoría porque tiene productos asociados.';
    }
}

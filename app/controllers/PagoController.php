<?php

require_once __DIR__ . '/../models/Pago.php';

class PagoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Pago();
    }

    public function index()
    {
        $pagos = $this->model->getAll();

        require_once __DIR__ . '/../views/Pago/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Pago/create.php';
    }

    public function guardar()
    {
        $id_factura = $_POST['id_factura'];
        $id_metodo_pago = $_POST['id_metodo_pago'];
        $valor = $_POST['valor'];
        $referencia = $_POST['referencia'];
        $fecha_pago = $_POST['fecha_pago'];
        $estado = $_POST['estado'];

        $resultado = $this->model->create(
            $id_factura,
            $id_metodo_pago,
            $valor,
            $referencia,
            $fecha_pago,
            $estado
        );

        if ($resultado) {
            $this->index();
        } else {
            echo "Error al guardar el pago";
        }
    }
}
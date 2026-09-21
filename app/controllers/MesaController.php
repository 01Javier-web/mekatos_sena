<?php

require_once __DIR__ . '/../Models/Mesa.php';

class MesaController
{
    public function index()
    {
        $mesa = new Mesa();

        $mesas = $mesa->getAll();

        require_once __DIR__ . '/../Views/mesa/index.php';
    }

    public function show($id)
    {
        $mesa = new Mesa();

        $mesaData = $mesa->getById($id);

        require_once __DIR__ . '/../Views/mesa/show.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/mesa/create.php';
    }

    public function store()
    {
        $mesa = new Mesa();

        $number = $_POST['number'];
        $name = $_POST['name'] ?? '';
        $capacity = $_POST['capacity'] ?? null;
        $qrToken = bin2hex(random_bytes(16));

        $mesa->create(
            $number,
            $name,
            $capacity,
            $qrToken
        );

        header('Location: /mesas');
        exit;
    }

    public function edit($id)
    {
        $mesa = new Mesa();

        $mesaData = $mesa->getById($id);

        require_once __DIR__ . '/../Views/mesa/edit.php';
    }

    public function update($id)
    {
        $mesa = new Mesa();

        $number = $_POST['number'];
        $name = $_POST['name'] ?? '';
        $capacity = $_POST['capacity'] ?? null;
        $status = $_POST['status'];

        $mesa->update(
            $id,
            $number,
            $name,
            $capacity,
            $status
        );

        header('Location: /mesas');
        exit;
    }

    public function updateStatus($id)
    {
        $mesa = new Mesa();

        $status = $_POST['status'];

        $mesa->updateStatus(
            $id,
            $status
        );

        header('Location: /mesas');
        exit;
    }

    public function delete($id)
    {
        $mesa = new Mesa();

        $mesa->delete($id);

        header('Location: /mesas');
        exit;
    }
}
<?php

require_once __DIR__ . '/../config/database.php';


$database = new Database();

$db = $database->connect();

if ($db) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar a la base de datos.";
}

if ($method === 'GET') {
    $sql = "SELECT * FROM restaurant_tables";
    $stmt = $db->query($sql);
    $mesas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once __DIR__ . '/../app/views/Mesa/index.php';
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
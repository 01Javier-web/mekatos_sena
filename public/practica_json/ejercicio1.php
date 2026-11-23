<?php

$productos = [
    [
        "id" => 1,
        "nombre" => "Mouse",
        "precio" => 35000,
        "stock" => 12,
        "disponibilidad" => true
    ],
    [
        "id" => 2,
        "nombre" => "Teclado",
        "precio" => 65000,
        "stock" => 8,
        "disponibilidad" => true
    ],
    [
        "id" => 3,
        "nombre" => "Monitor",
        "precio" => 780000,
        "stock" => 6,
        "disponibilidad" => false
    ],
    [
        "id" => 4,
        "nombre" => "Audifonos",
        "precio" => 95000,
        "stock" => 15,
        "disponibilidad" => true
    ]
];

$json = json_encode($productos, JSON_PRETTY_PRINT);

echo "<pre>";
echo $json;
echo "</pre>";

?>
<?php

$contenido = file_get_contents("productos.json");

$productos = json_decode($contenido, true);

echo "<h2>Lista de productos</h2>";

foreach ($productos as $producto) {
    echo "Nombre: " . $producto["nombre"] . "<br>";
    echo "Precio: $" . $producto["precio"] . "<br><br>";
}

echo "<h2>Productos con precio superior a $100.000</h2>";

foreach ($productos as $producto) {
    if ($producto["precio"] > 100000) {
        echo $producto["nombre"] . " - $" . $producto["precio"] . "<br>";
    }
}

?>
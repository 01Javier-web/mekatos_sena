<?php

$contenido = file_get_contents("productos.json");
$productos = json_decode($contenido, true);

$idBuscado = 2;
$productoEncontrado = false;

foreach ($productos as &$producto) {

    if ($producto["id"] == $idBuscado) {

        $precioAnterior = $producto["precio"];
        $producto["precio"] = 180000;

        $productoEncontrado = true;
        break;
    }
}

unset($producto);

$jsonActualizado = json_encode($productos, JSON_PRETTY_PRINT);

if ($productoEncontrado) {
    echo "<h2>Producto modificado correctamente</h2>";
    echo "ID: " . $idBuscado . "<br>";
    echo "Precio anterior: $" . $precioAnterior . "<br>";
    echo "Precio nuevo: $180000<br>";

    echo "<h3>JSON actualizado:</h3>";
    echo "<pre>" . $jsonActualizado . "</pre>";
} else {
    echo "No se encontró el producto.";
}

?>
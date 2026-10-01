<?php

require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/CategoriaController.php';
require_once __DIR__ . '/../app/Controllers/ProductoController.php';
require_once __DIR__ . '/../app/Controllers/MesaController.php';
require_once __DIR__ . '/../app/Controllers/RolController.php';
require_once __DIR__ . '/../app/Controllers/EstadoPedidoController.php';
require_once __DIR__ . '/../app/Controllers/PedidoController.php';
require_once __DIR__ . '/../app/Controllers/DetallePedidoController.php';
require_once __DIR__ . '/../app/Controllers/FacturaController.php';
require_once __DIR__ . '/../app/Controllers/PagoController.php';


/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

if (!isset($_GET['controller'])) {
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Proyecto Mekatos</title>
    </head>

    <body>

        <h1>Proyecto Mekatos</h1>

        <h2>Módulos del sistema</h2>

        <ul>

            <li>
                <a href="?controller=user&action=index">
                    Usuarios
                </a>
            </li>

            <li>
                <a href="?controller=categoria&action=index">
                    Categorías
                </a>
            </li>

            <li>
                <a href="?controller=producto&action=index">
                    Productos
                </a>
            </li>

            <li>
                <a href="?controller=mesa&action=index">
                    Mesas
                </a>
            </li>

            <li>
                <a href="?controller=rol&action=index">
                    Roles
                </a>
            </li>

            <li>
                <a href="?controller=estado_pedido&action=index">
                    Estados de pedido
                </a>
            </li>

            <li>
                <a href="?controller=pedido&action=index">
                    Pedidos
                </a>
            </li>

            <li>
                <a href="?controller=detalle_pedido&action=index">
                    Detalles de pedido
                </a>
            </li>

            <li>
                <a href="?controller=factura&action=index">
                    Facturas
                </a>
            </li>

            <li>
                <a href="?controller=pago&action=index">
                    Pagos
                </a>
            </li>

        </ul>

    </body>

    </html>

    <?php

    exit;
}


/*
|--------------------------------------------------------------------------
| Enrutamiento
|--------------------------------------------------------------------------
*/

$controllerName = $_GET['controller'];

$action = $_GET['action'] ?? 'index';


$controllers = [
    'user' => UserController::class,
    'categoria' => CategoriaController::class,
    'producto' => ProductoController::class,
    'mesa' => MesaController::class,
    'rol' => RolController::class,
    'estado_pedido' => EstadoPedidoController::class,
    'pedido' => PedidoController::class,
    'detalle_pedido' => DetallePedidoController::class,
    'factura' => FacturaController::class,
    'pago' => PagoController::class
];


if (!isset($controllers[$controllerName])) {
    die('Controlador no encontrado');
}


$controllerClass = $controllers[$controllerName];

$controller = new $controllerClass();


if (!method_exists($controller, $action)) {
    die('Acción no encontrada');
}


$controller->$action();

?>
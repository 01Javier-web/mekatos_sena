
<?php

$modulos = [
    'categoria' => 'Categorías',
    'producto' => 'Productos',
    'mesa' => 'Mesas',
    'rol' => 'Roles',
    'user' => 'Usuarios',
    'estado_pedido' => 'Estados de pedido',
    'pedido' => 'Pedidos',
    'detalle_pedido' => 'Detalles de pedido',
    'factura' => 'Facturas',
    'pago' => 'Pagos',
];

// Si no se seleccionó un módulo, mostrar el inicio.
if (!isset($_GET['controller']) || $_GET['controller'] === '') {
    echo '<h1>MEKATOS</h1>';
    echo '<h2>Módulos del sistema</h2>';
    echo '<ul>';

    foreach ($modulos as $nombreControlador => $nombreModulo) {
        echo '<li><a href="?controller='
            . htmlspecialchars($nombreControlador, ENT_QUOTES, 'UTF-8')
            . '&action=index">'
            . htmlspecialchars($nombreModulo, ENT_QUOTES, 'UTF-8')
            . '</a></li>';
    }

    echo '</ul>';
    exit;
}

$controller = $_GET['controller'];
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'categoria':
        require_once __DIR__ . '/../app/controllers/CategoriaController.php';
        $controller = new CategoriaController();
        break;

    case 'mesa':
        require_once __DIR__ . '/../app/controllers/MesaController.php';
        $controller = new MesaController();
        break;

    case 'producto':
        require_once __DIR__ . '/../app/controllers/ProductoController.php';
        $controller = new ProductoController();
        break;

    case 'rol':
        require_once __DIR__ . '/../app/controllers/RolController.php';
        $controller = new RolController();
        break;

    case 'user':
        require_once __DIR__ . '/../app/controllers/UserController.php';
        $controller = new UserController();
        break;

    case 'estado_pedido':
        require_once __DIR__ . '/../app/controllers/EstadoPedidoController.php';
        $controller = new EstadoPedidoController();
        break;

    case 'pedido':
        require_once __DIR__ . '/../app/controllers/PedidoController.php';
        $controller = new PedidoController();
        break;

    case 'detalle_pedido':
        require_once __DIR__ . '/../app/controllers/DetallePedidoController.php';
        $controller = new DetallePedidoController();
        break;

    case 'factura':
        require_once __DIR__ . '/../app/controllers/FacturaController.php';
        $controller = new FacturaController();
        break;

    case 'pago':
        require_once __DIR__ . '/../app/controllers/PagoController.php';
        $controller = new PagoController();
        break;

    default:
        http_response_code(404);
        echo 'Controlador no encontrado';
        exit;
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    http_response_code(404);
    echo 'Acción no encontrada';
}

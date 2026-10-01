<?php

$controller = $_GET['controller'] ?? 'categoria';
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

        echo "Controlador no encontrado";

        exit;
}


if (method_exists($controller, $action)) {

    $controller->$action();

} else {

    echo "Acción no encontrada";

}

<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if (
    $basePath !== '' &&
    $basePath !== '/' &&
    strpos($uri, $basePath) === 0
) {
    $uri = substr($uri, strlen($basePath));
}

$uri = '/' . trim($uri, '/');

$rutas = require __DIR__ . '/../routes/web.php';

if (isset($rutas[$method][$uri])) {

    [$nombreControlador, $nombreMetodo] = $rutas[$method][$uri];

    $archivoControlador = __DIR__ . '/../app/controllers/' . $nombreControlador . '.php';

    if (file_exists($archivoControlador)) {

        require_once $archivoControlador;

        if (class_exists($nombreControlador)) {

            $controlador = new $nombreControlador();

            if (method_exists($controlador, $nombreMetodo)) {

                $controlador->$nombreMetodo();
                exit;
            }
        }
    }

    http_response_code(404);
    echo "No se encontró el controlador o método solicitado.";
    exit;
}

$rutaProcesada = false;

switch ($uri) {

    case '/productos/editar':

        require_once __DIR__ . '/../app/controllers/ProductoController.php';

        $productoController = new ProductoController();

        if ($method === 'GET') {
            $productoController->editar();
            $rutaProcesada = true;
        }

        break;

    case '/productos/crear':

        require_once __DIR__ . '/../app/controllers/ProductoController.php';

        $productoController = new ProductoController();

        if ($method === 'GET') {
            $productoController->crear();
            $rutaProcesada = true;
        }

        if ($method === 'POST') {
            $productoController->guardar();
            $rutaProcesada = true;
        }

        break;

    case '/productos/actualizar':

        require_once __DIR__ . '/../app/controllers/ProductoController.php';

        $productoController = new ProductoController();

        if ($method === 'POST') {
            $productoController->actualizar();
            $rutaProcesada = true;
        }

        break;

    case '/productos/eliminar':

        require_once __DIR__ . '/../app/controllers/ProductoController.php';

        $productoController = new ProductoController();

        if ($method === 'POST') {
            $productoController->eliminar();
            $rutaProcesada = true;
        }

        break;

    case '/productos':

        require_once __DIR__ . '/../app/controllers/ProductoController.php';

        $productoController = new ProductoController();

        if ($method === 'GET') {
            $productoController->index();
            $rutaProcesada = true;
        }

        break;
}

if ($rutaProcesada) {
    exit;
}

$controller = $_GET['controller'] ?? '';
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

if (
    is_string($action) &&
    method_exists($controller, $action) &&
    is_callable([$controller, $action])
) {

    $controller->$action();

} else {

    http_response_code(404);
    echo 'Acción no encontrada';
}

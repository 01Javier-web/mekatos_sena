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
    'pago' => 'Pagos'
];

if (
    $uri === '/' &&
    (!isset($_GET['controller']) || $_GET['controller'] === '')
) {

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


// Cargar las rutas del proyecto
$rutas = require_once __DIR__ . '/../routes/web.php';

// Buscar la ruta según el método HTTP y la URL
if (isset($rutas[$method][$uri])) {

    // Obtener controlador y método
    [$nombreControlador, $nombreMetodo] = $rutas[$method][$uri];

    // Construir la ruta del archivo del controlador
    $archivoControlador = __DIR__ . '/../app/controllers/' . $nombreControlador . '.php';

    // Comprobar que exista el archivo
    if (file_exists($archivoControlador)) {

        require_once $archivoControlador;

        // Comprobar que exista la clase
        if (class_exists($nombreControlador)) {

            // Crear instancia del controlador
            $controlador = new $nombreControlador();

            // Comprobar que exista el método
            if (method_exists($controlador, $nombreMetodo)) {

                // Ejecutar el método correspondiente
                $controlador->$nombreMetodo();

                exit;

            } else {
                http_response_code(404);
                echo "La acción solicitada no existe.";
                exit;
            }

        } else {
            http_response_code(500);
            echo "No se encontró la clase del controlador.";
            exit;
        }

    } else {
        http_response_code(500);
        echo "No se encontró el archivo del controlador.";
        exit;
    }
}

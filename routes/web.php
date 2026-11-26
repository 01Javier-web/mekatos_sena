
<?php

$rutas = [

    // RUTAS GET
    "GET" => [

        "/" => ["HomeController", "index"],

        // Categorías
        "/categorias" => ["CategoriaController", "index"],
        "/categorias/crear" => ["CategoriaController", "crear"],
        "/categorias/editar" => ["CategoriaController", "editar"],

        // Productos
        "/productos" => ["ProductoController", "index"],
        "/productos/crear" => ["ProductoController", "crear"],
        "/productos/editar" => ["ProductoController", "editar"],

        // Mesas
        "/mesas" => ["MesaController", "index"],
        "/productos/json" => ["ProductoController", "listarJson"],
        "/mesas/crear" => ["MesaController", "crear"],
        "/mesas/editar" => ["MesaController", "editar"],

        // Roles
        "/roles" => ["RolController", "index"],
        "/roles/crear" => ["RolController", "crear"],
        "/roles/editar" => ["RolController", "editar"],

        // Usuarios
        "/usuarios" => ["UserController", "index"],
        "/usuarios/crear" => ["UserController", "crear"],
        "/usuarios/editar" => ["UserController", "editar"],

        // Estados de pedido
        "/estados-pedido" => ["EstadoPedidoController", "index"],
        "/estados-pedido/crear" => ["EstadoPedidoController", "crear"],
        "/estados-pedido/editar" => ["EstadoPedidoController", "editar"],

        // Pedidos
        "/pedidos" => ["PedidoController", "index"],
        "/pedidos/crear" => ["PedidoController", "crear"],
        "/pedidos/editar" => ["PedidoController", "editar"],

        // Detalles de pedido
        "/detalles-pedido" => ["DetallePedidoController", "index"],
        "/detalles-pedido/crear" => ["DetallePedidoController", "crear"],
        "/detalles-pedido/editar" => ["DetallePedidoController", "editar"],

        // Facturas
        "/facturas" => ["FacturaController", "index"],
        "/facturas/crear" => ["FacturaController", "crear"],
        "/facturas/editar" => ["FacturaController", "editar"],

        // Pagos
        "/pagos" => ["PagoController", "index"],
        "/pagos/crear" => ["PagoController", "crear"],
        "/pagos/editar" => ["PagoController", "editar"],
    ],

    // RUTAS POST
    "POST" => [

        // Categorías
        "/categorias/guardar" => ["CategoriaController", "guardar"],
        "/categorias/actualizar" => ["CategoriaController", "actualizar"],
        "/categorias/eliminar" => ["CategoriaController", "eliminar"],

        // Productos
        "/productos/guardar" => ["ProductoController", "guardar"],
        "/productos/actualizar" => ["ProductoController", "actualizar"],
        "/productos/eliminar" => ["ProductoController", "eliminar"],

        // Mesas
        "/mesas/guardar" => ["MesaController", "guardar"],
        "/mesas/actualizar" => ["MesaController", "actualizar"],
        "/mesas/eliminar" => ["MesaController", "eliminar"],

        // Roles
        "/roles/guardar" => ["RolController", "guardar"],
        "/roles/actualizar" => ["RolController", "actualizar"],
        "/roles/eliminar" => ["RolController", "eliminar"],

        // Usuarios
        "/usuarios/guardar" => ["UserController", "guardar"],
        "/usuarios/actualizar" => ["UserController", "actualizar"],
        "/usuarios/eliminar" => ["UserController", "eliminar"],

        // Estados de pedido
        "/estados-pedido/guardar" => ["EstadoPedidoController", "guardar"],
        "/estados-pedido/actualizar" => ["EstadoPedidoController", "actualizar"],
        "/estados-pedido/eliminar" => ["EstadoPedidoController", "eliminar"],

        // Pedidos
        "/pedidos/guardar" => ["PedidoController", "guardar"],
        "/pedidos/actualizar" => ["PedidoController", "actualizar"],
        "/pedidos/eliminar" => ["PedidoController", "eliminar"],

        // Detalles de pedido
        "/detalles-pedido/guardar" => ["DetallePedidoController", "guardar"],
        "/detalles-pedido/actualizar" => ["DetallePedidoController", "actualizar"],
        "/detalles-pedido/eliminar" => ["DetallePedidoController", "eliminar"],

        // Facturas
        "/facturas/guardar" => ["FacturaController", "guardar"],
        "/facturas/actualizar" => ["FacturaController", "actualizar"],
        "/facturas/eliminar" => ["FacturaController", "eliminar"],

        // Pagos
        "/pagos/guardar" => ["PagoController", "guardar"],
        "/pagos/actualizar" => ["PagoController", "actualizar"],
        "/pagos/eliminar" => ["PagoController", "eliminar"],
    ],

];

return $rutas;

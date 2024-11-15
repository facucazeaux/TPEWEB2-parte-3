<?php
require_once 'Libs/router.php';
require_once 'apps/controller/controller.serie.php';
require_once 'apps/Middlewares/jwt.auth.middleware.php';
require_once 'apps/controller/user.controller.php';
require_once 'apps/controller/controller.genero.php';


$router = new Router();

$router->addMiddleware(new JWTAuthMiddleware());

$router->addRoute('serie', 'GET', 'controllerSerie', 'getAll');
$router->addRoute('serie/:id', 'GET', 'controllerSerie', 'getById');
$router->addRoute('serie/:id', 'DELETE', 'controllerSerie', 'EliminarSerie');
$router->addRoute('serie/', 'POST', 'controllerSerie', 'Agregar_Serie');
$router->addRoute('serie/:id', 'PUT', 'controllerSerie', 'EditarSerie');


$router->addRoute('genero', 'GET', 'controllerGenero', 'getAll');
$router->addRoute('genero/:id', 'GET', 'controllerGenero', 'getGeneroPorId');
$router->addRoute('genero/:id', 'PUT', 'controllerGenero', 'editarGenero');
$router->addRoute('genero/:id', 'DELETE', 'controllerGenero', 'EliminarGenero');
$router->addRoute('genero/', 'POST', 'controllerGenero', 'Agregar_Genero');


$router->addRoute('usuarios/token'    ,            'GET',     'UserApiController',   'getToken');






// Verificar que el recurso esté definido antes de llamar al método route()
if (isset($_GET['resource'])) {
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
} else {
    echo "Error: No se especificó el recurso en la solicitud.";
}

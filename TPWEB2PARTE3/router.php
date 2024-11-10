<?php
print_r($_SERVER);
require_once 'Libs/router.php';

require_once 'apps/controller/controller.serie.php';
// require_once 'apps/controller/controller.categoria.php';
//require_once 'apps/controller/controller.user.php';


 $router = new Router();


//#               //   endpoint         verbo       controller     metood
$router->addRoute('serie','GET','controllerSerie','getAll');
$router->addRoute('serie/:id','GET','controllerSerie','getById');


$router->route($_GET['resource'],$_SERVER['REQUEST_METHOD']);



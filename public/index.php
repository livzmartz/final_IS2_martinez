<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\GradosController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/grados', [GradosController::class,'index'] );
$router->post('/API/grados/guardar', [GradosController::class,'guardarAPI'] );
$router->post('/API/grados/modificar', [GradosController::class,'modificarAPI'] );
$router->post('/API/grados/eliminar', [GradosController::class,'eliminarAPI'] );
$router->get('/API/grados/buscar', [GradosController::class,'buscarAPI'] );
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

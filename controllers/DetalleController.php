<?php


namespace Controllers;

use Exception;
use Model\Aplicaciones;
use Model\Asignar;
use Model\Grados;
use Model\Programadores;
use Model\Tareas;
use MVC\Router;

class DetalleController
{
    public static function index(Router $router)
    {
       
        $router->render('detalle/index', [
        
        ]);
    }
}
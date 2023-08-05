<?php

namespace Controllers;

use Exception;
use Model\Aplicacion;
use MVC\Router;

class AplicacionController {
    public static function index(Router $router) {
        $aplicaciones = Aplicacion::all();
        
        $router->render('aplicaciones/index', [
            'aplicaciones' => $aplicaciones,
        ]);
    }

    public static function guardarAPI() {
        try {
            $aplicacion = new Aplicacion($_POST);
            $resultado = $aplicacion->guardar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarAPI() {
        try {
            $aplicacion = new Aplicacion($_POST);
            $resultado = $aplicacion->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI() {
        try {
            $app_id = $_POST['app_id'];
            $aplicacion = Aplicacion::find($app_id);
            $aplicacion->app_estado = 0;
            $resultado = $aplicacion->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI() {
        $app_nombre = $_GET['app_nombre'];

        $sql = "SELECT * FROM aplicaciones WHERE app_estado = '1'";
        if ($app_nombre != '') {
            $sql .= " AND app_nombre LIKE '%$app_nombre%'";
        }

        try {
            $aplicaciones = Aplicacion::fetchArray($sql);
            echo json_encode($aplicaciones);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
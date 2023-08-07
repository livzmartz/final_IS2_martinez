<?php

namespace Controllers;

use Exception;
use Model\Aplicaciones;
use MVC\Router;

class AplicacionesController {
    public static function index(Router $router) {
        $aplicaciones = Aplicaciones::all();
        
        $router->render('aplicaciones/index', [
            'aplicaciones' => $aplicaciones,
        ]);
    }

    public static function guardarAPI() {
        try {
            $aplicaciones = new Aplicaciones($_POST);
            $resultado = $aplicaciones->guardar();

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
            $aplicaciones = new Aplicaciones($_POST);
            $resultado = $aplicaciones->actualizar();

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
            $aplicaciones = Aplicaciones::find($app_id);
            $aplicaciones->app_estado = 0;
            $resultado = $aplicaciones->actualizar();

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
            $aplicaciones = Aplicaciones::fetchArray($sql);
            echo json_encode($aplicaciones); // Cambiado 0 a $aplicaciones
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
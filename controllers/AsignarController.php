<?php

namespace Controllers;

use Exception;
use Model\Asignar;
use MVC\Router;

class AsignarController {
    public static function index(Router $router) {
    
        
        $router->render('asignar/index', [
          
        ]);
    }

    public static function guardarAPI() {
        try {
            $asignar = new Asignar($_POST);
            $resultado = $asignar->guardar();

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
            $asignar = new Asignar($_POST);
            $resultado = $asignar->actualizar();

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
            $asig_id = $_POST['asig_id'];
            $asignar = Asignar::find($asig_id);
            $asignar->asig_sit = 0;
            $resultado = $asignar->actualizar();

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
        $asig_programador = $_GET['asig_programador'];
        $asig_app = $_GET['asig_app'];

        $sql = "SELECT * FROM asig_programador WHERE asig_sit = '1'";
        if ($asig_programador != '') {
            $sql .= " AND asig_programador = $asig_programador";
        }
        if ($asig_app != '') {
            $sql .= " AND asig_app = $asig_app";
        }

        try {
            $asignar = Asignar::fetchArray($sql);
            echo json_encode($asignar);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
} 
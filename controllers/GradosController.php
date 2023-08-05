<?php

namespace Controllers;

use Exception;
use Model\Grados;
use MVC\Router;

class GradoController {
    public static function index(Router $router) {
        $grados = Grados::all();
        
        $router->render('grados/index', [
            'grados' => $grados,
        ]);
    }

    public static function guardarAPI() {
        try {
            $grados = new Grados($_POST);
            $resultado = $grados->guardar();

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
            $grados = new Grados($_POST);
            $resultado = $grados->actualizar();

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
            $gra_id = $_POST['gra_id'];
            $grados = Grados::find($gra_id);
            $grados->gra_sit = 0;
            $resultado = $grados->actualizar();

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
        $gra_nombre = $_GET['gra_nombre'];

        $sql = "SELECT * FROM grados WHERE gra_sit = '1'";
        if ($gra_nombre != '') {
            $sql .= " AND gra_nombre LIKE '%$gra_nombre%'";
        }

        try {
            $grados = Grados::fetchArray($sql);
            echo json_encode($grados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
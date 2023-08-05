<?php

namespace Controllers;

use Exception;
use Model\Programadores;
use MVC\Router;

class ProgramadoresController {
    public static function index(Router $router) {
        $programadores = Programadores::all();
        
        $router->render('programadores/index', [
            'programadores' => $programadores,
        ]);
    }

    public static function guardarAPI() {
        try {
            $programadores = new Programadores($_POST);
            $resultado = $programadores->guardar();

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
            $programadores = new Programadores($_POST);
            $resultado = $programadores->actualizar();

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
            $prog_id = $_POST['prog_id'];
            $programadores = Programadores::find($prog_id);
            $programadores->prog_sit = 0;
            $resultado = $programadores->actualizar();

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
        $prog_correo = $_GET['prog_correo'];
        $prog_nombreS = $_GET['prog_nombreS'];
        $prog_apellidoS = $_GET['prog_apellidoS'];

        $sql = "SELECT * FROM programadores WHERE prog_sit = '1'";
        if ($prog_correo != '') {
            $sql .= " AND prog_correo LIKE '%$prog_correo%'";
        }

        if ($prog_nombreS != '') {
            $sql .= " AND prog_nombreS LIKE '%$prog_nombreS%'";
        }

        if ($prog_apellidoS != '') {
            $sql .= " AND prog_apellidoS LIKE '%$prog_apellidoS%'";
        }

        try {
            $programadores = Programadores::fetchArray($sql);
            echo json_encode($programadores);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
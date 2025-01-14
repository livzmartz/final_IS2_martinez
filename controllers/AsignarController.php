<?php

namespace Controllers;

use Exception;
use Model\Asignar;
use MVC\Router;

class AsignarController {
    public static function index(Router $router) {
    
        $programadores = static::BuscarProgramadores();
        $aplicaciones = static::BuscarAplicaciones();

        $router->render('asignar/index', [
          
            'programadores' => $programadores,
            'aplicaciones' => $aplicaciones,

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

        $sql = "    SELECT 
        asig_id,
        g.gra_nombre || ' ' || p.prog_nombres || ' ' || p.prog_apellidos AS programador, p.prog_id,
        a.app_nombre AS aplicacion, a.app_id
    FROM 
        asig_programador ap
        INNER JOIN programadores p ON ap.asig_programador = p.prog_id
        INNER JOIN grados g ON p.prog_grado = g.gra_id
        INNER JOIN aplicaciones a ON ap.asig_app = a.app_id
    WHERE 
        ap.asig_sit = '1'
    ORDER BY 
        programador, aplicacion;
        ";

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

    public static function BuscarProgramadores(){

        $sql = " select prog_id,  gra_nombre || ' ' || prog_nombres || ' ' || prog_apellidos AS nombre from programadores
        inner join grados on gra_id = prog_grado
 ";

    try {
        $programadores = Asignar::fetchArray($sql);
        return $programadores;
    } catch (Exception $e) {

    }
    
}

public static function BuscarAplicaciones(){

    try {
    $sql = "SELECT * FROM aplicaciones WHERE app_estado = '1'";

    $aplicaciones = Asignar::fetchArray($sql);
    return $aplicaciones;
} catch (Exception $e) {

}

}



} 
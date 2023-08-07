<?php

namespace Controllers;

use Exception;
use Model\Tareas;
use MVC\Router;

class TareasController {
    public static function index(Router $router) {
        
        $aplicaciones = static::BuscarAplicaciones();
        
        $router->render('tareas/index', [
            'aplicaciones' => $aplicaciones,
        ]);
    }

    public static function guardarAPI() {
        try {
            $fechaPost = $_POST['tar_fecha'];
            $fechaObjeto = date_create($fechaPost);
            $fechaFormateada = date_format($fechaObjeto, 'm/d/Y'); 
    
            $datosTarea = $_POST;
            $datosTarea['tar_fecha'] = $fechaFormateada;
    
            $tarea = new Tareas($datosTarea);
           
            $resultado = $tarea->guardar();
    
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
            $tareas = new Tareas($_POST);
            $resultado = $tareas->actualizar();

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
            $tar_id = $_POST['tar_id'];
            $tareas = Tareas::find($tar_id);
            $tareas->tar_estado = 0;
            $resultado = $tareas->actualizar();

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
        $tar_descripcion = $_GET['tar_descripcion'];
        $tar_fecha = $_GET['tar_fecha'];

        $sql = "SELECT * FROM tareas inner join aplicaciones on tar_app = app_id WHERE tar_estado = '1'";
        if ($tar_descripcion != '') {
            $sql .= " AND tar_descripcion LIKE '%$tar_descripcion%'";
        }
        if ($tar_fecha != '') {
            $sql .= " AND tar_fecha = '$tar_fecha'";
        }

        try {
            $tareas = Tareas::fetchArray($sql);
            echo json_encode($tareas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function BuscarAplicaciones(){
        $sql = "SELECT * FROM aplicaciones WHERE app_estado = '1'";

        try {
            $aplicaciones = Tareas::fetchArray($sql);
            return $aplicaciones;
        } catch (Exception $e) {
           
        }
    }
}

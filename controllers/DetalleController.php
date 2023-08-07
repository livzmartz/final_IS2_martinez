<?php

namespace Controllers;

use MVC\Router;
use Exception;
use Models\GradoModel;
use Models\ProgramadorModel;
use Models\AplicacionModel;
use Models\AsigProgramadorModel;
use Models\TareaModel;

class DetalleController
{
    public static function index(Router $router)
    {
        $detalles = static::getDetalles();

        $router->render('detalle/index', [
            'detalles' => $detalles
        ]);
    }

    public static function getDetalles()
    {
        $sql = "
        SELECT
            grados.*,
            programadores.*,
            aplicaciones.*,
            asig_programador.*,
            tareas.*
        FROM
            grados
        LEFT JOIN programadores ON programadores.prog_grado = grados.gra_id
        LEFT JOIN asig_programador ON asig_programador.asig_programador = programadores.prog_id
        LEFT JOIN aplicaciones ON aplicaciones.app_id = asig_programador.asig_app
        LEFT JOIN tareas ON tareas.tar_app = aplicaciones.app_id
        WHERE
            grados.gra_sit = '1'
            AND programadores.prog_sit = '1'
            AND aplicaciones.app_estado = '1'
            AND asig_programador.asig_sit = '1'
            AND tareas.tar_estado = '1';
    ";
    
    try {
        $detalles = getDetalles::fetchArray($sql);

        // Creamos un arreglo para agrupar los detalles por alguna categoría
        $detallesAgrupados = [];

        foreach ($detalles as $detalle) {
         
            $categoria = $detalle['nombre_categoria']; 

            if (!isset($detallesAgrupados[$categoria])) {
                $detallesAgrupados[$categoria] = [];
            }

            $detallesAgrupados[$categoria][] = $detalle;
        }

        // Ahora generamos la tabla para cada categoría y sus detalles
        foreach ($detallesAgrupados as $categoria => $detallesCategoria) {
            echo "<h2>$categoria</h2>";
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>No.</th>';
            echo '<th>Grado Programador</th>';
            echo '<th>Nombre programador</th>';
            echo '<th>Asignacion</th>';
            echo '<th>Descripcion Tarea</th>';
            echo '<th>Fecha</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            foreach ($detallesCategoria as $indice => $detalle) {
                echo '<tr>';
                echo '<td>' . ($indice + 1) . '</td>';
                echo '<td>' . $detalle['prog_grado'] . '</td>';
                echo '<td>' . $detalle['prog_nombres'] . '</td>';
                echo '<td>' . $detalle['asig_id'] . '</td>';
                echo '<td>' . $detalle['tar_descripcion'] . '</td>';
                echo '<td>' . $detalle['tar_fecha'] . '</td>';
                echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
        }
    } catch (Exception $e) {
        
        return [];
    }
}
}
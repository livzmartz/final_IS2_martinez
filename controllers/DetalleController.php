<?php


namespace Controllers;

use Exception;
use Model\Programador;
use Model\Grado;
use Model\Aplicacion;
use Model\Asignacion;
use Model\Tarea;
use MVC\Router;

class DetalleController
{
    public static function index(Router $router)
    {
        $programadoresPorAplicaciones = static::getProgramadoresPorAplicaciones();
        $router->render('detalle/index', [
            'programadoresPorAplicaciones' => $programadoresPorAplicaciones
        ]);
    }

    public static function getProgramadoresPorAplicaciones()
    {
        $sql = "
            SELECT
                p.prog_id,
                p.prog_nombres,
                p.prog_apellidos,
                p.prog_correo,
                g.gra_nombre,
                a.app_nombre,
                t.tar_descripcion,
                t.tar_fecha,
                t.tar_estado
            FROM
                programadores p
                JOIN grados g ON p.prog_grado = g.gra_id
                JOIN asig_programador ap ON p.prog_id = ap.asig_programador
                JOIN aplicaciones a ON ap.asig_app = a.app_id
                JOIN tareas t ON a.app_id = t.tar_app
            WHERE
                p.prog_sit = '1'
                AND g.gra_sit = '1'
                AND a.app_estado = '1'
                AND ap.asig_sit = '1'
                AND t.tar_estado = '1';
        ";

        try {
            // Ejecutar el query y obtener los resultados
            $programadoresPorAplicaciones = Programador::fetchArray($sql);

            // Organizar los resultados por aplicaciones
            $programadoresPorAplicacionesOrganizados = [];
            foreach ($programadoresPorAplicaciones as $programadorPorAplicacion) {
                $appNombre = $programadorPorAplicacion['app_nombre'];
                if (!isset($programadoresPorAplicacionesOrganizados[$appNombre])) {
                    $programadoresPorAplicacionesOrganizados[$appNombre] = [];
                }
                $programadoresPorAplicacionesOrganizados[$appNombre][] = $programadorPorAplicacion;
            }

            return $programadoresPorAplicacionesOrganizados;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} 
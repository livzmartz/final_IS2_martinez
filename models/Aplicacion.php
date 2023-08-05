<?php

namespace Model;

class Aplicacion extends ActiveRecord{
    public static $tabla = 'aplicaciones';
    public static $columnasDB = ['app_nombre','app_estado'];
    public static $idTabla = 'app_id';

    public $app_id;
    public $app_nombre;
    public $app_estado;

    public function __construct($args = [] )
    {
        $this->app_id = $args['app_id'] ?? null;
        $this->app_nombre = $args['app_nombre'] ?? '';
        $this->app_estado = $args['app_estado'] ?? 1;
    }

}
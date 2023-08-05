<?php

namespace Model;

class Tareas extends ActiveRecord{
    public static $tabla = 'tareas';
    public static $columnasDB = ['tar_app','tar_descripcion','tar_fecha','tar_estado'];
    public static $idTabla = 'tar_id';

    public $tar_id;
    public $tar_app;
    public $tar_descripcion;
    public $tar_fecha;
    public $tar_estado;

    public function __construct($args = []) 
    {
        $this->tar_id = $args['tar_id'] ?? null;
        $this->tar_app = $args['tar_app'] ?? '';
        $this->tar_descripcion = $args['tar_descripcion'] ?? '';
        $this->tar_fecha = $args['tar_fecha'] ?? '';
        $this->tar_estado = $args['tar_estado'] ?? 1;
    }
}
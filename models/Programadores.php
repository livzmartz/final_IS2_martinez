<?php

namespace Model;

class Programadores extends ActiveRecord{
    public static $tabla = 'programadores';
    public static $columnasDB = ['prog_correo','prog_grado','prog_nombres','prog_apellidos','prog_sit'];
    public static $idTabla = 'prog_id';

    public $prog_id;
    public $prog_correo;
    public $prog_grado;
    public $prog_nombres;
    public $prog_apellidos;
    public $prog_sit;

    public function __construct($args = []) 
    {
        $this->prog_id = $args['prog_id'] ?? null;
        $this->prog_correo = $args['prog_correo'] ?? '';
        $this->prog_grado = $args['prog_grado'] ?? '';
        $this->prog_nombres = $args['prog_nombres'] ?? '';
        $this->prog_apellidos = $args['prog_apellidos'] ?? '';
        $this->prog_sit = $args['prog_sit'] ?? 1;
    }

}
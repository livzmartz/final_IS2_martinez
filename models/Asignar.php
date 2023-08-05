<?php

namespace Model;

class Asignar extends ActiveRecord{

    public static $tabla = 'asig_programadores';
    public static $columnasDB = ['asig_programador','asig_app','asig_sit'];
    public static $idTabla = 'asig_id';

    public $asig_id;
    public $asig_programador;
    public $asig_app;
    public $asig_sit;

    public function __construct($args = []) 
    {
        $this->asig_id = $args['asig_id'] ?? null;
        $this->asig_programador = $args['asig_programador'] ?? '';
        $this->asig_app = $args['asig_app'] ?? '';
        $this->asig_sit = $args['asig_sit'] ?? 1;
    }

}
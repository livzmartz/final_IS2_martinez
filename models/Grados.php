<?php

namespace Model;

class Grados extends ActiveRecord{
    public static $tabla = 'grados';
    public static $columnasDB = ['gra_nombre','gra_sit'];
    public static $idTabla = 'gra_id';

    public $gra_id;
    public $gra_nombre;
    public $gra_sit;

    public function __construct($args = [] )
    {
        $this->gra_id = $args['gra_id'] ?? null;
        $this->gra_nombre = $args['gra_nombre'] ?? '';
        $this->gra_sit = $args['gra_sit'] ?? 1;
    }

}
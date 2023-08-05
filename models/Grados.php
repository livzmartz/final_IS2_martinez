<?php

namespace Model;

class Producto extends ActiveRecord{
    public static $tabla = 'productos';
    public static $columnasDB = ['producto_nombre','producto_precio','producto_situacion'];
    public static $idTabla = 'producto_id';
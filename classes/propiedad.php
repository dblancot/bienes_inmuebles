<?php

namespace App;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';

    //Array con el nombre de las columnas de la BBDD
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorID'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorID;

    // Constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ??  null;
        $this->titulo = $args['titulo'] ??  '';
        $this->precio = $args['precio'] ??  '';
        $this->imagen = $args['imagen'] ??  '';
        $this->descripcion = $args['descripcion'] ??  '';
        $this->habitaciones = $args['habitaciones'] ??  '';
        $this->wc = $args['wc'] ??  '';
        $this->estacionamiento = $args['estacionamiento'] ??  '';
        $this->creado = date('Y/m/d');
        $this->vendedorID = $args['vendedorID'] ??  '';        
    }


}

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

    // ----------- MÉTODOS ----------- \\


    public function validar() {  

        // Añadiendo los errores al array
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if( strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El número de plazas de garaje es obligatorio";
        }

        if(!$this->vendedorID) {
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        return self::$errores;
    }



}

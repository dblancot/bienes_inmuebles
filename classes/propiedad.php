<?php

namespace App;

class Propiedad {

    //BBDD
    protected static $db;

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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ??  '';
        $this->titulo = $args['titulo'] ??  '';
        $this->precio = $args['precio'] ??  '';
        $this->imagen = $args['imagen'] ??  'imagen.jpg';
        $this->descripcion = $args['descripcion'] ??  '';
        $this->habitaciones = $args['habitaciones'] ??  '';
        $this->wc = $args['wc'] ??  '';
        $this->estacionamiento = $args['estacionamiento'] ??  '';
        $this->creado = date('Y/m/d');
        $this->vendedorID = $args['vendedorID'] ??  '';        
    }

    public function guardar(){
        echo "Guardando en la bbdd";

        // Insertar en la base de datos
        $query = "  INSERT INTO propiedades (
                         titulo
                        ,precio
                        ,imagen
                        ,descripcion
                        ,habitaciones
                        ,wc
                        ,estacionamiento
                        ,creado
                        ,vendedorID
                        )
                    VALUES (
                         '$this->titulo'
                        ,'$this->precio'
                        ,'$this->imagen'
                        ,'$this->descripcion'
                        ,'$this->habitaciones'
                        ,'$this->wc'
                        ,'$this->estacionamiento'
                        ,'$this->creado'
                        ,'$this->vendedorID'
                    ) ";

        self::$db->query($query); // Ejecuto la query en la bbddgit
    }

    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

}

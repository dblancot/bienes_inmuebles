<?php

namespace App;

class Propiedad {

    // ----------- ATRIBUTOS ----------- \\

    //BBDD
    protected static $db;
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
    
    // ----------- MÉTODOS ----------- \\

    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    // Constructor
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

    // Guardar en la BBDD
    public function guardar(){  
        
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $stringKeys = join(', ', array_keys($atributos)); // Creo un string con las keys del array $atributos
        $stringValues = "'" . join('\', \'', array_values($atributos)) . "'"; // string con los values del array $atributos

        // Insertar en la base de datos
        $query = " INSERT INTO propiedades ($stringKeys) VALUES ($stringValues) "; 

        self::$db->query($query); // Ejecuto la query en la BBDD
    }

    // Meto en el array $atributos el valor de cada columna
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue; // ignoro la columna id
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value ) { // iteramos como array asociativo para poder acceder a ambos
            $sanitizado[$key] = self::$db->escape_string($value); // sanitizamos los datos
        }

        return $sanitizado;
    }    

}

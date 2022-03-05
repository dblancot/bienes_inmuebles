<?php

namespace App;

class Propiedad {

    // ----------- ATRIBUTOS ----------- \\

    //BBDD
    protected static $db;
    //Array con el nombre de las columnas de la BBDD
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorID'];
    
    //Validación
    protected static $errores = [];

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

    // Sanitización    
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value ) { // iteramos como array asociativo para poder acceder a ambos
            $sanitizado[$key] = self::$db->escape_string($value); // sanitizamos los datos
        }

        return $sanitizado;
    }  
    
    // Validación
    public static function getErrores() {
        return self::$errores;
    }

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
/*
        if(!$this->imagen['name'] || $this->imagen['error']) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
        
        //Validar por tamaño (1Mb máximo)
        $medida = 1000 * 1000;
        if($this->imagen['size'] > $medida) {
            self::$errores[] = 'La imagen tiene que ser menor de 100Kb';
        }
*/
        return self::$errores;
       
    }


}

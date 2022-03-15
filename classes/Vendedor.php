<?php

namespace App;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';

    //Array con el nombre de las columnas de la BBDD
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    // Constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ??  null;
        $this->nombre = $args['nombre'] ??  '';
        $this->apellido = $args['apellido'] ??  '';
        $this->telefono = $args['telefono'] ??  '';       
    }

    // Validación
    public function validar() {  

        // Añadiendo los errores al array
        if(!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre";
        }

        if(!$this->apellido) {
            self::$errores[] = "Debes añadir un apellido";
        }

        if(!$this->telefono) {
            self::$errores[] = "Debes añadir un teléfono";
        // expresión regular que solo acepta números del [0-9] y extensión de {9}    
        } else if(!preg_match('/[0-9]{9}/', $this->telefono)) { 
            self::$errores[] = "Formato de teléfono no válido";
        }

        return self::$errores;
    }

}

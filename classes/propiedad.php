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

    public function guardar(){
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Creando nuevo registro
            $this->crear();
        }
    } 

    // Guardar en la BBDD
    public function crear(){  
        
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $stringKeys = join(', ', array_keys($atributos)); // Creo un string con las keys del array $atributos
        $stringValues = "'" . join('\', \'', array_values($atributos)) . "'"; // string con los values del array $atributos

        // Insertar en la base de datos
        $query = " INSERT INTO propiedades ($stringKeys) VALUES ($stringValues) "; 

        $resultado = self::$db->query($query); // Ejecuto la query en la BBDD

        if($resultado) {
            // Redireccionar
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){

        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value ) {
            $valores[] = "{$key}='{$value}'";
        }

        // Insertar en la base de datos
        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ";
        
        $resultado = self::$db->query($query); // Ejecuto la query en la BBDD

        // Redireccionar enviando resultado = 1 por el GET
        if($resultado) {               
            header('Location: /admin?resultado=2');
        }     
    }

    // Eliminar un resgistro
    public function eliminar() {

        // Elimina la propiedad
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query); // Ejecuto la query en la BBDD

        if($resultado) {  
            $this->borrarImagen();             
            header('Location: /admin?resultado=3');
        }
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

    // Subida de archivos
    public function setImagen($imagen){
        
        if($imagen) {
            //Elimina la imagen previa            
            if(!is_null($this->id)) { // Si hay un id es porque estamos modificando el resgistro
                $this->borrarImagen();                
            }

            // Asigna al atributo imagen el nombre de la imagen.
            $this->imagen = $imagen;
        }
    }

    // Eliminar imagen
    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen); // Borra la imagen antigua
        }
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

        if(!$this->imagen) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        return self::$errores;       
    }

    // Enumera todas los inmuebles
    public static function all() {

        $query = " SELECT * FROM propiedades "; 

        $resultado = self::consultarSQL($query); // Ejecuto la query en la BBDD       

        return $resultado;
    }

    // Busca un registro por id
    public static function find($id) {
        $query = "   SELECT * FROM propiedades WHERE id = ${id} ";

        $resultado = self::consultarSQL($query); // Ejecuto la query en la BBDD       

        return array_shift($resultado); // Devuelve la primera posición del array
    }

    // Ejecuta consulta a la bbdd retornando un array de objetos
    public static function consultarSQL($query) {
        // consultar bbdd
        $resultado = self::$db->query($query); // Ejecuto la query en la BBDD

        // iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) { 
            $array[] = self::crearObjeto($registro);
        }
        
        // liberar memoria
        $resultado->free();

        // return los resultados
        return $array;
    }
        
    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) { // Si existe la key y no tiene valor nulo
                $this->$key = $value; // actualizo el objeto $propiedad
            }
        }
    }

}

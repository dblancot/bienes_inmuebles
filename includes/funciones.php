<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {    
    session_start();
    
    if(!$_SESSION['login']) { // Si no está autenticado lo mando al index
        header('Location: /');
    }
}

function debug($variable) {    
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Evita inyección de HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de Contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos); // Busca el string $tipo en el array $tipos, si existe true
}
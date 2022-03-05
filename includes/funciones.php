<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

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
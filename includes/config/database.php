<?php

require 'variables.php'; // Cargo autoload de classes

function conectarDB() : mysqli {
    $db = new mysqli( SERVER, USER, PASSWORD, BBDD );
    $db->set_charset("utf8");

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return($db);
}
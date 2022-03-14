<?php

require 'variables.php'; // Cargo autoload de classes

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', PASSWORD ,'bienes_inmuebles');
    $db->set_charset("utf8");

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return($db);
}
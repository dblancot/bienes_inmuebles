<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root','Dener2016!','bienes_inmuebles');
    $db->set_charset("utf8");

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return($db);
}
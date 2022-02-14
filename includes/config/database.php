<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root','Dener2016!','bienes_inmuebles');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return($db);
}
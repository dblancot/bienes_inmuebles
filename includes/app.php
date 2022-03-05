<?php

require 'funciones.php'; // Cargo funciones.php
require 'config/database.php'; // Cargo configuración de la bbdd
require __DIR__ . '/../vendor/autoload.php'; // Cargo autoload de classes


// Conexión a la bbdd
$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);



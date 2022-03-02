<?php

require 'funciones.php'; // Cargo funciones.php
require 'config/database.php'; // Cargo configuración de la bbdd
require __DIR__ . '/../vendor/autoload.php'; // Cargo autoload de classes

use App\Propiedad;

$propiedad = new Propiedad;


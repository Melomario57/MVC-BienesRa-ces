<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarse a la base de datos
$db =  conectarDB();

use Model\ActiveRecord;

// Todos los objetos que se creen tendrán la refrencia estatica a la BD porque no cambia
ActiveRecord::setDB($db);

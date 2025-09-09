<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';


// Conectarse a la base de datos
$db =  conectarDB();



// Todos los objetos que se creen tendrán la refrencia estatica a la BD porque no cambia
ActiveRecord::setDB($db);

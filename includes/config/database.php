<?php



function conectarDB(): mysqli
{

    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');

    if (!$db) {
        echo ('Error no se pudo conectar');
        exit; // Se coloca exit para dejar de ejecutar la conexión si hay un error y se evita mostrar infromación delicada
    }

    return $db;
}

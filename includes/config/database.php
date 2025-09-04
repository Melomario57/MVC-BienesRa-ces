<?php



function conectarDB(): mysqli
{



    $db = new mysqli('mysql-bienesraicesmario.alwaysdata.net', 'bienesraicesmario', 'bienesraices12', 'bienesraicesmario_mvc');

    $db->set_charset("utf8");

    if (!$db) {
        echo ('Error no se pudo conectar');
        exit; // Se coloca exit para dejar de ejecutar la conexión si hay un error y se evita mostrar infromación delicada
    }

    return $db;
}

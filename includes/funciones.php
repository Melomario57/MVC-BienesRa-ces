<?php
define('TEMPLATES_URL', __DIR__ . '/templates'); // Con "__DIR__" nos ayuda a encontrar una ruta de archivos más precisa y ahorra que escribamos toda la ruta
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

// Una función que se va a llamar para reemplazar a los includes
function incluirTemplate(string $nombre, bool $inicio = false) // Si la variable inicio no esta presente en un archivo su valor predeterminado sera false
{
    include TEMPLATES_URL . "/{$nombre}.php"; // Aquí llamo a la constante para llamar a las plantillas
}

function estaAutenticado()
{
    session_start();

    // Si solo voy a retornar valores no es necesario escribir un else
    if (!$_SESSION['login']) {
        header('Location: /');
    }
    return true;
}

function debuguear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Escapar / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
        case 3:
            $mensaje = 'Eliminando Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORediriccionar(string $url)
{
    // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
    }
    return $id;
}

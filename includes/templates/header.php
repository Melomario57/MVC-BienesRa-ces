<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio</title>
    <link rel="stylesheet" href="/build/css/app.css" /> <!-- Hay que ponerle "/"(buscar en la raíz) a todos los build para que detecte los estilos -->
</head>

<body> <!-- Se elimino el isset, porque ya contamos con una función para saber si esta o no presente la variable de incio -->
    <header class="header <?php echo $inicio ? 'inicio' : '';  ?>"> <!-- Se agrega la clase de inicio si estamos en index -->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img
                        class="logo-header"
                        src="/build/img/logo.svg"
                        alt="Logotipo Bienes Raíces" />
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive" />
                </div>

                <div class="derecha">
                    <img
                        src="/build/img/dark-mode.svg"
                        alt="Imágen Luna"
                        class="dark-mode-boton" />
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a><a href="anuncios.php">Anuncios</a> <a href="blog.php">Blog</a><a href="contacto.php">Contacto</a>
                        <?php if ($auth): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>

            </div>
            <!-- Cierre de la barra -->
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
        </div>
    </header>
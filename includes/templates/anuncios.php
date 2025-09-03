<?php

use App\Propiedad;



if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get(3);
}
?>

<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) { ?>
        <div class="anuncio">
            <div class="img-height">
                <img class="img-altura" loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio" />
            </div>
            <div class="contenido-anuncio">
                <h2><?php echo $propiedad->titulo; ?></h2>
                <div class="contenido-descripcion">
                    <p>
                        <?php echo $propiedad->descripcion; ?>
                    </p>
                </div>
                <p class="precio"><?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="/build/img/icono_wc.svg"
                            alt="icono wc" />
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="/build/img/icono_estacionamiento.svg"
                            alt="icono estacionamiento" />
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="/build/img/icono_dormitorio.svg"
                            alt="icono habitaciones" />
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                    Ver propiedad</a>
            </div>
            <!-- .contenido-anuncio -->
        </div>
    <?php } ?>
</div><!-- .contenedor-anuncios -->
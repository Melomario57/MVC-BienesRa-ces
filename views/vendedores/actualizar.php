<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

    <a href="/admin/" class="boton boton-verde">Volver</a>

    <!-- Iterar sobre los errores para irlos mostrando -->
    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <!-- El enctype es para leer los archivos -->
    <!-- enctype="multipart/form-data" -->
    <form class="formulario" method="POST">
        <?php include 'formulario.php' ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde" />
    </form>
</main>
<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /* Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class); // Para usar el intervation image
                // Leer la imagen
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }


            $errores = array_filter($propiedad->validar());


            if (empty($errores)) {
                /* SUBIDA DE ARCHIVOS */

                // Método para ver si existe una carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORediriccionar('/admin');

        $propiedad = Propiedad::find($id);

        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        // Método POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);

            $errores = $propiedad->validar();

            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {

                if ($_FILES['propiedad']['tmp_name']['imagen']) {

                    //Generar un nombre único
                    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                    //Realiza un resize a la imagen con intervention
                    $manager = new Image(Driver::class);
                    $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);

                    /*Setear la imagen*/
                    $propiedad->setImagen($nombreImagen);

                    //Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }


        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Comprobar que existan las variables

            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}

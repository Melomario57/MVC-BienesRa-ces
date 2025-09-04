<?php

namespace MVC;

$currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
class Router
{
    public $rutasGet = [];
    public $rutasPost = [];

    public function get($url, $fn)
    {
        $this->rutasGet[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPost[$url] = $fn;
    }


    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;
        // Arreglo de rutas protegidas...
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar'
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {

            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        // Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            // La URL existe y hay una función asociada

            call_user_func($fn, $this); //Llamar a una función que no sabemos como se llama
        } else {
            echo "Página No Encontrada";
        }
    }

    // Muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacenamiento en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpiar memoria

        include __DIR__ . "/views/layout.php";
    }
}

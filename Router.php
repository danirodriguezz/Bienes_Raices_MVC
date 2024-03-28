<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $function) {
        $this->rutasGET[$url] = $function;
    }

    public function post($url, $function) {
        $this->rutasPOST[$url] = $function;
    }

    public function comprobarRutas() {
        session_start();
        $auth = $_SESSION["login"] ?? null;

        //Asignamos las rutas que son protegidas
        $rutas_protegidas = [
        //     "/admin", 
        //     "/propiedades/crear", 
        //     "/propiedades/actualizar",
        //     "/propiedades/eliminar",
        //     "/vendedores/crear",
        //     "/vendedores/actualizar",
        //     "/vendedores/eliminar"
        ];
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
        
        if($metodo === "GET") {
            $funcion = $this->rutasGET[$urlActual] ?? null;
        } else {
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }

        //Protegemos las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header("Location: /");
        }

        if($funcion) {
            //La URL existe y hay una funcion asociada
            call_user_func($funcion, $this);
        } else {
            echo "Págian no encontrada...";
        }
    }
    //Muestra una vista
    public function render($view, $datos = []) {
        //Iteramos todos los datos
        foreach($datos as $key => $value) {
            $$key = $value;
        }
        //Guardando la vista en memoria
        ob_start();
        include __DIR__ . "/views/$view.php";
        //guardando la vista en una variable y limpiamos la memoria
        $contenido = ob_get_clean();    
        include __DIR__ . "/views/layout.php";
    }
}
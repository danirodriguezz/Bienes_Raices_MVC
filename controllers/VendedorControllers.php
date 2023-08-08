<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;


class VendedorControllers {
    public static function crear(Router $router) {
        $vendedor = new Vendedor;
        //Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Creamos el objeto de vendedor
            $vendedor = new Vendedor($_POST["vendedor"]);
            //Validamos los errores
            $errores = $vendedor->validarErrores();
            //Revisamos si el array de errores esta vacio 
            if(empty($errores)) {
                $resultado = $vendedor->guardar();
                if ($resultado) {
                    header("Location: /admin?resultado=1");
                    exit();
                }
            }
        }
        $router->render("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar("/admin");
        $vendedor = Vendedor::find($id);
        //Arreglo con los mensajes de errores
        $errores = Vendedor::getErrores();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST["vendedor"];
            //Sincronizamos el objeto que tengo en la clase con lo que envia el usuraio
            $vendedor->sincronizar($args);
            //Validamos los errores 
            $errores = $vendedor->validarErrores();
            if(empty($errores)) {
                //Actualizamos los datos
                $vendedor->guardar();
            }
        }
        $router->render("/vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id) {
                $tipo = $_POST["tipo"];
                //Validamos que existe el tipo
                if(validarTipoContenido($tipo)) {
                    if($tipo === "vendedor") {
                        //Eliminando vendedor
                        $vendedor = Vendedor::find($id);
                        $vendedor->eliminar();
                    }
                }
            }
        }
    }
}
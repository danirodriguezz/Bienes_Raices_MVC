<?php
namespace Controllers;
use MVC\Router;
use Model\Admin;



class LoginControllers {
    public static function login(Router $router) {
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            if(empty($errores)) {
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();
                if(!$resultado) {
                    //Verificar si el usuario existe(mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if(!$autenticado) {
                        //Password incorrecto (Mensaje de error)
                        $errores = Admin::getErrores();
                    } else {
                        //Autenticar al usuario
                        $auth->autenticar();
                    }
                }
            }
        }
        $router->render("auth/login", [
            "errores" => $errores
        ]);
    }
    public static function logout() {
        session_start();
        $_SESSION = [];
        header("Location: /");
    }
}
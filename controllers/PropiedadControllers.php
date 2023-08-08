<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadControllers {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //Muestra del mesaje de resultado de la operacion
        $resultado = $_GET["resultado"] ?? null;
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "vendedores" => $vendedores
        ]);
    }
    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Creando una nueva instancia
            $propiedad = new Propiedad($_POST["propiedad"]);
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
                // Seteamos la imagen
                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->validarErrores();
            //Revisamos si el array de errores esta vacio
            if(empty($errores)) {
                //Creamos la carpeta para subir imagenes 
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                
                //Guardamos la imagen en el servidor 
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                //Guardar en la base de datos
                $resultado = $propiedad->guardar();
                if ($resultado) {
                    header("Location: http://localhost:8000/admin?resultado=1");
                    exit();
                }
            }
        }
        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar("/admin");
        if($_SERVER["PATH_INFO"] === "/propiedades/actualizar") {
            $propiedad = Propiedad::find($id);
            $errores = Propiedad::getErrores();
            $vendedores = Vendedor::all();
        } else {
            $vendedor = Vendedor::find($id);
            //Arreglo con los mensajes de errores
            $errores = Vendedor::getErrores();
        }

        // Este codigo se ejecuta despues de que el usuario envie el formulario
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Asignamos los atributos
            $args = $_POST["propiedad"];
            //Sincronizando los nuevos datos con los que estan en memoria 
            $propiedad->sincronizar($args);
            //Validando errores
            $errores = $propiedad->validarErrores();
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
                // Seteamos la imagen
                $propiedad->setImagen($nombreImagen);
            }

            if(empty($errores)) {
                if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                    //Almacenamos la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                //  Actualizamos los datos
                $propiedad->guardar();
            }
        }
        $router->render("/propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores
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
                    if($tipo === "propiedad") {
                        //Eliminando propiedad
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                    }                
                }
            }
        }
    }
}
<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasControllers {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => $inicio
        ]);
    }
    public static function nosotros(Router $router) {
        $router->render("paginas/nosotros", []);
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();
        $router->render("paginas/propiedades",[
            "propiedades" => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarORedireccionar("/admin");
        $propiedad = Propiedad::find($id);
        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router->render("paginas/blog");
    }

    public static function entrada(Router $router) {
        $router->render("paginas/entrada");
    }

    public static function contacto(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $mensaje = null;
            $respuestas = $_POST["contacto"];
            //Creamos una instancia de PHPMailer
            $mail = new PHPMailer();
            //Configuracion de SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '6ce4fcb665c659';
            $mail->Password = 'ec10046f2f9d8e';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configuramos el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitamos el HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas["nombre"] . '</p>';
            if($respuestas["contacto"] === "Teléfono") {
                $contenido .= '<p>Eligio ser contactado por Teléfono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas["telefono"] . '</p>';
                $contenido .= '<p>Fecha de Contacto: ' . $respuestas["fecha"] . '</p>';
                $contenido .= '<p>Hora de Contacto: ' . $respuestas["hora"] . '</p>';
            } else {
                //Eligio ser contactado por Email
                $contenido .= '<p>Eligio ser contactado por E-mail</p>';
                $contenido .= '<p>Email: ' . $respuestas["email"] . '</p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuestas["mensaje"] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas["tipo"] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas["precio"] . '</p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            //Enviamos el Email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }

        }
        $router->render("paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }
}
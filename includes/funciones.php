<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function incluirTemplates( string $nombre, bool $inicio = false) {
    // echo TEMPLATES_URL . "/{$nombre}.php";
    include TEMPLATES_URL . "/{$nombre}.php";
};

function estaAuntenticado() {
    session_start();
    if(!$_SESSION["login"]) {
        return header("Location: /Bienes_raices/");
    }
}

function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa el HTML
function sanitizar($html) : string {
    $sanitizado = htmlspecialchars($html);
    return $sanitizado; 
}

//Validar tipo de Contenido
function validarTipoContenido($tipo) {
    $tipos = ["vendedor", "propiedad"];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo) {
    $mensaje = "";
    switch($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url) {
        //Validar el id 
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id) {
            header("Location: {$url}");
        }
        return $id;
}
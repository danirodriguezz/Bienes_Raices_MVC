<?php 
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION["login"] ?? false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/Bienes_raices/build/css/app.css">
</head>
<body class="dark-mode">
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/Bienes_raices/">
                    <img class="logotipo" src="/Bienes_raices/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/Bienes_raices/build/img/barras.svg" alt="barras del menu responsive">
                </div>
                <nav class="navegacion">
                    <a href="/Bienes_raices/nosotros.php">Nosotros</a>
                    <a href="/Bienes_raices/anuncios.php">Anuncios</a>
                    <a href="/Bienes_raices/blog.php">Blog</a>
                    <a href="/Bienes_raices/contacto.php">Contacto</a>
                    <?php if($auth): ?>
                        <a href="/Bienes_raices/cerrar-sesion.php" class="boton-rojo-margin0">Cerrar sesión</a>
                        <a href="/Bienes_raices/admin/" class="boton-verde-margin0">Administrar</a>
                    <?php endif ?>
                </nav>
            </div> <!-- barra -->
            <?php if ($inicio) { ?>
            <h1>Venta de Casas y Departamentos Exclusivos</h1>
            <?php }?>
        </div>
    </header>
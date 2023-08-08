<?php 
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION["login"] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body class="dark-mode">
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logotipo" src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="barras del menu responsive">
                </div>
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <?php if($auth): ?>
                        <a href="/logout" class="boton-rojo-margin0">Cerrar sesión</a>
                        <a href="/admin" class="boton-verde-margin0">Administrar</a>
                    <?php endif ?>
                </nav>
            </div> <!-- barra -->
            <?php if ($inicio) { ?>
            <h1>Venta de Casas y Departamentos Exclusivos</h1>
            <?php }?>
        </div>
    </header>

    <?php echo $contenido;?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/Bienes_raices/nosotros.php">Nosotros</a>
                <a href="/Bienes_raices/anuncios.php">Anuncios</a>
                <a href="/Bienes_raices/blog.php">Blog</a>
                <a href="/Bienes_raices/contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos Reservados <?php echo date("Y"); ?> &copy;</p>
    </footer>
    <script src="/build/js/bundle.min.js"></script>
</body>
</html>
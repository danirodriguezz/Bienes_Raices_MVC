<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <?php include "iconos.php"?>
</main>
<section class="seccion contenedor">
    <h2>Casas Y Departamentos en Venta </h2>
    <?php
        include "listado.php";
    ?>
    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>
<section class="imagen-contacto">
    <h2>Encuntra la casa de tus sueños</h2>
    <p>Llena el formulario un asesor se pondrá en contacto contigo</p>
    <a href="contacto.php" class="boton-amarillo-inline-block">Contáctanos</a>
</section>
<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        <!-- Entrada blog -->
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                    <p>Consejo para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                </a>
            </div>
        </article>
        <!-- Fin entrada blog -->
        <!-- Entrada blog -->
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                    <p>Maxímiza el espacio de tu hogar y aprende a usar los colores que mas favorezen para tu hogar</p>
                </a>
            </div>
        </article>
        <!-- Fin entrada blog -->
    </section>
    <section class="testimoniales">
        <h3>Testimonios</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó de una exelente forma, muy buena atención y la casa que me ofrecieron cumple todas mis expectativas
            </blockquote>
            <p>- Daniel Rodriguez Alonso</p>
        </div>
    </section>
</div>
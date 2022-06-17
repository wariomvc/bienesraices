<?php 
/* require 'includes/app.php';
$inicio = true;

incluir_template('header', true) */
$inicio='inicio';
 ?>
    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="" srcset="">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ullam, molestias eaque id culpa rem
                    ad, nam sit in architecto magnam quaerat maiores rerum aperiam debitis veritatis eos modi nisi.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="" srcset="">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ullam, molestias eaque id culpa rem
                    ad, nam sit in architecto magnam quaerat maiores rerum aperiam debitis veritatis eos modi nisi.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="" srcset="">
                <h3>Algo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ullam, molestias eaque id culpa rem
                    ad, nam sit in architecto magnam quaerat maiores rerum aperiam debitis veritatis eos modi nisi.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Casas en Venta</h2>
        <div class="contenedor-anuncios">
            <?php // incluir_template("anuncio")?>
        </div> <!-- Contenedor de Anuncios -->
        <div class="ver-todos alinear-derecha">
            <a href="" class="boton-verde">Ver Todos</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la Casa de tus Sueños</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio porro non cumque at quasi delectus libero,
            praesentium dolore quam excepturi repellendus! Magni quis cum reiciendis cupiditate provident voluptatum
            doloribus officia!</p>
        <div>
            <a href="" class="boton-amarillo">Contactanos</a>

        </div>

    </section>
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="entrada-imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img src="build/img/blog1.jpg" alt="">
                    </picture>
                </div>
                <div class="entrada-contenido">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span class="informacion-meta">20/10/2022</span > por: <span class="informacion-meta">Admin</span></p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint quas et repellendus maiores ex
                            cumque magnam, repudiandae commodi molestiae similique sapiente provident velit illum illo
                            cum, qui, ad corporis. Aspernatur?</p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="entrada-imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img src="build/img/blog2.jpg" alt="">
                    </picture>
                </div>
                <div class="entrada-contenido">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span class="informacion-meta">20/10/2022</span> por: <span class="informacion-meta">Admin</span></p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint quas et repellendus maiores ex
                            cumque magnam, repudiandae commodi molestiae similique sapiente provident velit illum illo
                            cum, qui, ad corporis. Aspernatur?</p>
                    </a>
                </div>
            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus iste hic excepturi laudantium
                    itaque quas officia totam libero. Mollitia alias commodi atque at quisquam voluptas magnam officiis,
                    sit iusto numquam?
                </blockquote>
                <p>-Alejandro Guzman</p>
            </div>
        </section>
    </div>
    <script src="build/js/bundle.min.js"></script>
</body>

</html>
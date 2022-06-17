<?php

$auth = isAutenticado();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Bienes Raices</title>
</head>

<body>

    <header class="header <?php
                            if (isset($inicio)) {
                                echo $inicio ? 'inicio' : '';
                            } ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logototipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="" class="boton-dark">
                    <nav class="navegacion">
                        <a href="/nosotros" class="" id="">Nosotros</a>
                        <a href="/anuncios" class="" id="">Anuncios</a>
                        <a href="/blog" class="" id="">Blog</a>
                        <a href="/contacto" class="" id="">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php if (isset($inicio)) : ?>
                <h1>Ventas de Casas y Departamentos de Lujo</h1>
            <?php endif ?>
        </div>
    </header>
<?php echo $contenido ?>
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php" class="" id="">Nosotros</a>
                <a href="anuncios.php" class="" id="">Anuncios</a>
                <a href="blog.php" class="" id="">Blog</a>
                <a href="contacto.php" class="" id="">Contacto</a>
            </nav>
            <p>Todos los Derechos Reservados <?php echo date('Y') ?></p>
        </div>

    </footer>
    <script src="build/js/bundle.min.js"></script>
</body>

</html>
<?php require('includes/funciones.php');
    incluir_template('header')
 ?>    <main class="contenedor seccion">
        <h1>Casas y Depas en Venta</h1>
        <div class="contenedor-anuncios">
        <?php incluir_template("anuncio")?>
        </div>
    </main>
    <?php incluir_template('footer')?>
    <script src="build/js/bundle.min.js"></script>
</body>

</html>
<?php require('../../includes/funciones.php');
require '../../includes/config/database.php';

$auth = isAutenticado();
if (!$auth) {
    header('Location: /');
}
    incluir_template('header')
 ?>
    <main class="contenedor seccion">
        <h1>Borrar</h1>
        
    </main>
    
    <?php incluir_template('footer')?>
    <script src="build/js/bundle.min.js"></script>
</body>

</html>
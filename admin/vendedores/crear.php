<?php

require '../../includes/app.php';
use App\Vendedor;

$auth = isAutenticado();
if (!$auth) {
    header('Location: /');
}

Vendedor::setDB($db);
$vendedor = new Vendedor();
$errores = Vendedor::getErorres();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre_imagen = md5(uniqid(rand())) . ".jpg";
    $vendedor = new Vendedor($_POST);
    $errores = $vendedor->validar();
      
    
    $errores = $vendedor->getErorres();
    if (empty($errores)) {
        $r = $vendedor->guardar();
        
        
        //echo $query;      
        if ($r) {
            header('Location: /admin?res=1');
        }
    }
}

incluir_template('header');
?>
<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/index.php" class="boton-verde" id="">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    </div>

    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include ('../../includes/templates/formulario_vendedores.php')?>
    </form>
</main>

<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>
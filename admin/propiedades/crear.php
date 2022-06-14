<?php

require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

$auth = isAutenticado();
if (!$auth) {
    header('Location: /');
}


$propiedad = new Propiedad();
Vendedor::setDB($db);
$vendedores = Vendedor::getAll();
$errores = Propiedad::getErorres();

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre_imagen = md5(uniqid(rand())) . ".jpg";
    $propiedad = new Propiedad($_POST);
    $errores = $propiedad->validar();
    $propiedad->setImagen($nombre_imagen,$_FILES['imagen']);
    
    $carpeta_imagenes = '../../imagenes/';
    if (!is_dir($carpeta_imagenes)) {
        mkdir($carpeta_imagenes);
    }
    
    $errores = $propiedad->getErorres();
    if (empty($errores)) {
        $propiedad::setDB($db);
        $r = $propiedad->guardar();
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $image->save($carpeta_imagenes.$nombre_imagen);
        
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

    <form action="/admin/propiedades/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include ('../../includes/templates/formulario_propiedades.php')?>
    </form>
</main>

<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>
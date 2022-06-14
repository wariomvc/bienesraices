<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';


$auth = isAutenticado();

if (!$auth) {
    header('Location: /');
}

$db = conectarBD();
$propiedad = new Propiedad();
Propiedad::setDB($db);
$vendedores = Vendedor::getAll();


$id_propiedad = $_GET['id'];
$id_propiedad = filter_var($id_propiedad, FILTER_VALIDATE_INT);
$propiedad->cargarPropiedad($id_propiedad);

$consulta2 = "SELECT * FROM vendedores";
$resultado_vendedores = mysqli_query($db, $consulta2);

$errores = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad->sincroniza($_POST);
    
    $errores = $propiedad->validar();

    $nombre_imagen = md5(uniqid(rand())) . ".jpg";
    

    $carpeta_imagenes = '../../imagenes/';
    if (!is_dir($carpeta_imagenes)) {
        mkdir($carpeta_imagenes);
    }

    if(!$_FILES['imagen']['error']){
        $propiedad->setImagen($nombre_imagen,$_FILES['imagen']);
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $image->save($carpeta_imagenes.$nombre_imagen);
    }else{
        $propiedad->setImagen($propiedad->imagen);
    }

    
    if (empty($errores)) {
        $r = $propiedad->Actualizar();
        if ($r) {
            header('Location: /admin?res=2');
        }
    }
}

incluir_template('header');

?>
<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin/index.php" class="boton-verde" id="">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    </div>

    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include ("../../includes/templates/formulario_propiedades.php")?>
    </form>
</main>

<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>
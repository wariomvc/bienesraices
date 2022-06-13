<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';


$auth = isAutenticado();

if (!$auth) {
    header('Location: /');
}

$db = conectarBD();
$propiedad_guardada = new Propiedad();
Propiedad::setDB($db);


$id_propiedad = $_GET['id'];
$id_propiedad = filter_var($id_propiedad, FILTER_VALIDATE_INT);
$propiedad_guardada->cargarPropiedad($id_propiedad);

$consulta2 = "SELECT * FROM vendedores";
$resultado_vendedores = mysqli_query($db, $consulta2);

$msg_errores = [];
$titulo = $propiedad_guardada->titulo;
$precio = $propiedad_guardada->precio;
$descripcion = $propiedad_guardada->descripcion;
$habitaciones = $propiedad_guardada->habitaciones;
$wc = $propiedad_guardada->wc;
$estacionamiento = $propiedad_guardada->estacionamiento;
$vendedorId = $propiedad_guardada->vendedorId;
$imagen_propiedad = $propiedad_guardada->imagen;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedorId'];

    $nombre_imagen = md5(uniqid(rand())) . ".jpg";
    $propiedad = new Propiedad($_POST);
    $propiedad->id = $propiedad_guardada->id;
    $errores = $propiedad->validar();

    $carpeta_imagenes = '../../imagenes/';
    if (!is_dir($carpeta_imagenes)) {
        mkdir($carpeta_imagenes);
    }

    if(!$_FILES['imagen']['error']){
        $propiedad->setImagen($nombre_imagen,$_FILES['imagen']);
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $image->save($carpeta_imagenes.$nombre_imagen);
    }else{
        $propiedad->setImagen($imagen_propiedad);
    }

    


    
    if (empty($msg_errores)) {
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

    <?php foreach ($msg_errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    </div>

    <form method="POST" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="titulo de propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">
            <img src="/imagenes/<?php echo $imagen_propiedad ?>" alt="" class="imagen-small">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Descripción Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" name="habitaciones" id="habitaciones" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc ">Baños</label>
            <input type="number" name="wc" id="wc" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" name="estacionamiento" id="estacionamiento" min="1" max="9" value="<?php echo $estacionamiento ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorId" id="vendedorId">
                <option value="">-- Seleeccione Un Vendedor --</option>
                <?php while ($vendedor   = mysqli_fetch_assoc($resultado_vendedores)) : ?>
                    <option <?php echo $vendedor['id'] === $vendedorId ? "selected" : ''; ?> value="<?php echo $vendedor['id']  ?>"><?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido'] ?></option>
                <?php endwhile ?>
            </select>
        </fieldset>
        <input type="submit" value="Enviar">
    </form>
</main>

<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>
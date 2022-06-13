<?php

require '../../includes/app.php';
use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

$auth = isAutenticado();
if (!$auth) {
    header('Location: /');
}

$db = conectarBD();

$consulta = "SELECT * FROM  vendedores";
$resultado = mysqli_query($db, $consulta, MYSQLI_STORE_RESULT);




$errores = Propiedad::getErorres();
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedorId'];
    //$imagen_propiedad = $_POST['imagen'];
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
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="titulo de propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

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
                <?php while ($vendedor   = mysqli_fetch_assoc($resultado)) : ?>
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
<?php
require '../../includes/app.php';

use App\Propiedad;

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

    $propiedad = new Propiedad($_POST);
    $errores = $propiedad->validar();



    /* $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
    $imagen = $_FILES['imagen'];
    $creado =  date('Y/m/d'); */

    

    if (empty($errores)) {
        $propiedad::setDB($db);
        $propiedad->guardar();

        //echo $query;
        $carpeta_imagenes = '../../imagenes/';
        if (!is_dir($carpeta_imagenes)) {
            mkdir($carpeta_imagenes);
        }
        $nombre_imagen = md5(uniqid(rand())) . ".jpg";

        $res = move_uploaded_file($imagen['tmp_name'], $carpeta_imagenes . $nombre_imagen);
        /* var_dump($res);
        var_dump($imagen);
        var_dump(($nombre_imagen));
        exit; */
        $query = "INSERT INTO propiedades (titulo, precio,imagen, descripcion, habitaciones, wc, estacionamiento,creado, vendedorId)
        VALUES ('$titulo', '$precio','$nombre_imagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento','$creado', '$vendedorId')";
        try {
            //code...
            $r = mysqli_query($db, $query);
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th);
        }

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
<?php

use App\Propiedad;

require '../../includes/app.php';


$auth = isAutenticado();

if (!$auth) {
    header('Location: /');
}

$db = conectarBD();
$propiedad = new Propiedad();
Propiedad::setDB($db);


$id_propiedad = $_GET['id'];
$id_propiedad = filter_var($id_propiedad, FILTER_VALIDATE_INT);
$propiedad->cargarPropiedad($id_propiedad);

/* $consulta = "SELECT * FROM  propiedades WHERE id='$id_propiedad'";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado); */

$consulta2 = "SELECT * FROM vendedores";
$resultado_vendedores = mysqli_query($db, $consulta2);

//var_dump($propiedad);

$msg_errores = [];
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
$imagen_propiedad = $propiedad['imagen'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "<pre>";
    var_dump($_FILES);

    echo "</pre>";


    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor_id']);
    $imagen = $_FILES['imagen'];
    $creado =  date('Y/m/d');

    if (empty($titulo)) {
        $msg_errores[] = "Debes Añadir un Titulo";
    };
    if (empty($precio)) {
        $msg_errores[] = "Debes Añadir un precio";
    }
    if (strlen($descripcion) < 50) {
        $msg_errores[] = "La Descripción debe contener más de 50 caracteres";
    }
    if ($habitaciones < 1) {
        $msg_errores[] = "Debe ser por lo menos una Habitación";
    }

    if ($wc < 1) {
        $msg_errores[] = "Debe ser por lo menos una WC";
    }
    if ($estacionamiento < 1) {
        $msg_errores[] = "Debe ser por lo menos una Estacionamiento";
    }
    $size = 1000 * 100;
    if (!$imagen['size'] > $size) {
        $msg_errores[] = "La imagen es muy grande ($imagen->size)";
    }

    if ($vendedorId === "") {
        $msg_errores[] = "Debe ser por lo menos una Estacionamiento";
    }

    if (empty($msg_errores)) {

        /* Borrar imagen anterior */

        //echo $query;
        $carpeta_imagenes = '../../imagenes/';
        if (!is_dir($carpeta_imagenes)) {
            mkdir($carpeta_imagenes);
        }

        if ($imagen['name']) {
            var_dump($imagen['name']);
            var_dump($imagen_propiedad);
            if (!empty($imagen_propiedad)) {
                unlink($carpeta_imagenes . $imagen_propiedad);
            }

            $nombre_imagen = md5(uniqid(rand())) . ".jpg";
            $res = move_uploaded_file($imagen['tmp_name'], $carpeta_imagenes . $nombre_imagen);
        } else {
            $nombre_imagen = $imagen_propiedad;
        }


        /* var_dump($res);
        var_dump($imagen);
        var_dump(($nombre_imagen));
        exit; */


        $query = "UPDATE propiedades SET 
            titulo = '$titulo',
            precio = '$precio',
            imagen = '$nombre_imagen',
            descripcion = '${descripcion}',
            habitaciones = '$habitaciones',
            wc = '$wc',
            estacionamiento = '$estacionamiento',
            vendedorId = '$vendedorId'
            WHERE id = ${id_propiedad}";
        //$query = htmlspecialchars($query);



        $r = mysqli_query($db, $query);


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
            <select name="vendedor_id" id="vendedor_id">
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
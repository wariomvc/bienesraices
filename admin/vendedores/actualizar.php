<?php

use App\Vendedor;
require '../../includes/app.php';


$auth = isAutenticado();

if (!$auth) {
    header('Location: /');
}

$db = conectarBD();
$vendedor = new Vendedor();
Vendedor::setDB($db);


$id_vendedor = $_GET['id'];
$id_vendedor = filter_var($id_vendedor, FILTER_VALIDATE_INT);
$vendedor->getById($id_vendedor);

$consulta2 = "SELECT * FROM vendedores";
$resultado_vendedores = mysqli_query($db, $consulta2);

$errores = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor->sincroniza($_POST);
    
    $errores = $vendedor->validar();


    
    if (empty($errores)) {
        $r = $vendedor->Actualizar();
        if ($r) {
            header('Location: /admin?res=2');
        }
    }
}

incluir_template('header');

?>
<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin/index.php" class="boton-verde" id="">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    </div>

    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include ("../../includes/templates/formulario_vendedores.php")?>
    </form>
</main>

<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>
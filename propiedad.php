<?php require('includes/funciones.php');
incluir_template('header');
/* Iimportamos la conexion */
require __DIR__ . '/includes/config/database.php';
$db = conectarBD();
/* Extraemos el id de la propiedad */
$id = $_GET['id'] ?? null;
if ($id) {
    /* Consultar Propiedades */
    $query = "SELECT * FROM propiedades WHERE id=${id}";
    $resultado = mysqli_query($db, $query);
    $propiedad = mysqli_fetch_assoc($resultado);
}


?>
<?php if($id):?>
<main class="contenedor seccion">
    <h1><?php echo $propiedad['titulo']; ?></h1>
    <div class="propiedad-contenido">
        <div class="propiedad-imagen">
            <picture>
                
                <img src="/imagenes/<?php echo $propiedad['imagen'] ?>" alt="Sobre Nosotros">
            </picture>
        </div>
        <p class="propiedad-precio"><?php echo "$ ".$propiedad['precio']; ?></p>
        <ul class="propiedad-caracteristicas">
            <li>
                <img src="build/img/icono_dormitorio.svg" alt="">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
            <li>
                <img src="build/img/icono_estacionamiento.svg" alt="">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img src="build/img/icono_wc.svg " alt="">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
        </ul>
        <div class="propiedad-texto">
            <p><?php echo $propiedad['descripcion']; ?></p>

        </div>
    </div>
</main>
<?php endif ?>
<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>

</body>

</html>
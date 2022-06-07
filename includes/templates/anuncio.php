<?php 
/* Iimportamos la conexion */
require __DIR__ . '../../config/database.php';
$db = conectarBD();

/* Consultar Propiedades */

$query = "SELECT * FROM propiedades";
$resultado = mysqli_query($db, $query);

?>
<?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
<div class="anuncio">
    <picture>
        
        <img src="/imagenes/<?php echo $propiedad['imagen'] ?>" alt="">
    </picture>
    <div class="anuncio-contenido">
        <h3>Casa de Lujo</h3>
        <p><?php echo $propiedad['descripcion']?></p>
        <p class="anuncio-precio"><?php echo $propiedad['precio'] ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img src="build/img/icono_dormitorio.svg" alt="">
                <p><?php echo $propiedad['habitaciones']?></p>
            </li>
            <li>
                <img src="build/img/icono_estacionamiento.svg" alt="">
                <p><?php echo $propiedad['estacionamiento']?></p>
            </li>
            <li>
                <img src="build/img/icono_wc.svg " alt="">
                <p><?php echo $propiedad['wc']?></p>
            </li>
        </ul>
        <a href="propiedad.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Detalles de Propiedad</a>
    </div>

</div><!-- Anuncio -->
<?php endwhile ?>
<?php mysqli_close($db); ?>
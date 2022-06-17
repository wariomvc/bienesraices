
<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/index.php" class="boton-verde" id="">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    </div>

    <form action="" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include ('../includes/templates/formulario_propiedades.php')?>
    </form>
</main>


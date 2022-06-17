<?php




?>
<main class="contenedor seccion">
    <h1>Administración</h1>
    
        <?php if (intval($respuesta) === 1) : ?>
            <p class="alerta exito">Se Agregó Correctamente</p>
        <?php endif; ?>
        <?php if (intval($respuesta) === 2) : ?>
            <p class="alerta exito">Actualización Exitosa</p>
        <?php endif; ?>
        <?php if (intval($respuesta) === 3) : ?>
            <p class="alerta exito">Se Eliminó Correctamente</p>
        <?php endif; ?>
    
  
    <a href="/admin/propiedades/crear" class="boton-verde" id="">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Titulo</td>
                <td>Imagen</td>
                <td>Precio</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id ?></td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="" class="imagen-tabla"></td>
                    <td><?php echo "$" . $propiedad->precio ?></td>
                    <td>
                        <a href="/admin/propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-verde-block">Editar</a>
                        <form action="admin/propiedades/borrar" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>

                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>
<section class="contenedor seccion">
    <h2>Vendedores</h2>
    <a href="/admin/vendedores/crear" class="boton-verde" id="">Nuevo Vendedor</a>
    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Appelido</td>
                <td>Teléfono</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id ?></td>
                    <td><?php echo $vendedor->nombre ?></td>
                    <td><?php echo $vendedor->apellido ?></td>
                    <td><?php echo $vendedor->telefono ?></td>
                    <td>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id ?>" class="boton-verde-block">Editar</a>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>

                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>
<!-- Cerrar conexión de BD -->

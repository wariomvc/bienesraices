<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" placeholder="titulo de propiedad" value="<?php echo s($propiedad->titulo) ?>">

    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio" value="<?php echo s($propiedad->precio) ?>">

    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion"><?php echo s($propiedad->descripcion) ?></textarea>
</fieldset>
<fieldset>
    <legend>Descripción Propiedad</legend>
    <label for="habitaciones">Habitaciones</label>
    <input type="number" name="habitaciones" id="habitaciones" min="1" max="9" value="<?php echo ($propiedad->habitaciones) ?>">

    <label for="wc ">Baños</label>
    <input type="number" name="wc" id="wc" min="1" max="9" value="<?php echo ($propiedad->wc) ?>">

    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" name="estacionamiento" id="estacionamiento" min="1" max="9" value="<?php echo ($propiedad->estacionamiento) ?>">
</fieldset>
<fieldset>
    <legend>Vendedor</legend>

    <select name="vendedorId" id="vendedorId">
        <option value="">-- Seleeccione Un Vendedor --</option>
        <?php foreach ($vendedores  as $vendedor) : ?>
            <option <?php echo $vendedor->id === $propiedad->vendedorId ? "selected" : ''; ?> value="<?php echo $vendedor->id  ?>">
                <?php echo $vendedor->nombre . ' ' . $vendedor->apellido ?>
            </option>
        <?php endforeach ?>
    </select>
</fieldset>
<input type="hidden" name="tipo" value="propiedad">
<input type="submit" value="Enviar" class="boton boton-verde-block">
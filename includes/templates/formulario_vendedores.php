<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre de Vendedor" value="<?php echo s($vendedor->nombre) ?>">

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" value="<?php echo s($vendedor->apellido) ?>">

    <label for="telefono">Teléfono</label>
    <input name="telefono" id="telefono" type="tel" value="<?php echo s($vendedor->telefono) ?>">
</fieldset>
<input type="submit" value="Enviar" class="boton boton-verde-block">
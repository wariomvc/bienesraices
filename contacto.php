<?php require('includes/funciones.php');
    incluir_template('header',false)
 ?>
    <main class="contenedor">
        <h1>Titulo Página</h1>
        <div class="contacto-contenido">
            <div class="contacto-imagen">
                <div class="propiedad-imagen">
                    <picture>
                        <source srcset="build/img/destacada2.webp" type="image/webp">
                        <source srcset="build/img/destacada2.jpg" type="image/jpg">
                        <img src="build/img/destacada2.jpg" alt="Sobre Nosotros">
                    </picture>
                </div>
                <h1>Llene el formulario de Contacto</h1>
                <div class="formulario-contacto">
                    <form action="" class="formulario">
                        <fieldset>
                            <legend>Información Personal</legend>
                            <label for="nombre">Nombre</label>
                            <input type="text" placeholder="Tu Nombre" name="nombre" id="nombre">
                            <label for="email">Email</label>
                            <input type="email" placeholder="Tu Email" name="email" id="email">
                            <label for="telefono">Telefono</label>
                            <input type="telefono" placeholder="Tu Telefono" name="telefono" id="telefono">
                            <label for="mensaje">mensaje</label>
                            <textarea name="mensaje" id="mensaje" cols="30" rows="5"></textarea>
                        </fieldset>
                        <fieldset>
                            <legend>Información Sobre la Propiedad</legend>
                            <label for="opciones-compra">Compra o Vende</label>
                            <select name="opciones-compra" id="opciones-compra">
                                <option value="" disabled selected>--Seleccione--</option>
                                <option value="compra">compra</option>
                                <option value="vende">Vende</option>
                            </select>
                            <label for="presupuesto">Presupuesto</label>
                            <input type="text" name="presupuesto" id="presupuesto" placeholder="Cual es su Presupuesto">
                        </fieldset>
                        <fieldset>
                            <legend>Informacion de Contacto</legend>
                            <p>Como desea ser Contactado</p>
                            <div class="contactos">
                                <label for="contactar-telefono">Telefono:</label>
                                <input type="radio" name="contactar" id="contactar-telefono">
                                <label for="contactar-email">Email:</label>
                                <input type="radio" name="contactar" id="contactar-email">
                            </div>
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha">
                            <label for="hora">Hora</label>
                            <input type="time" name="hora" id="hora" min="9:00" max="18:00">
                            
                        </fieldset>
                        <input type="submit" value="Enviar" class="boton-verde">
                    </form>
                </div>
            </div>
    </main>
    <?php incluir_template('footer')?>
    <script src="build/js/bundle.min.js"></script>
</body>

</html>
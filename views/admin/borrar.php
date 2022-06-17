<?php 
$auth = isAutenticado();
if (!$auth) {
    header('Location: /');
}

 ?>
    <main class="contenedor seccion">
        <h1>Borrar</h1>
        
    </main>
  
<?php 
require 'includes/config/database.php';
$db = conectarBD();

require('includes/funciones.php');
incluir_template('header');
$errores = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    var_dump($_POST);
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db,$_POST['password']);
    
    if (!$email) {
        $errores[]= "El Email es obligatorio";
    }
    if (!$password) {
        $errores[]= "El Password es obligatorio";
    }
    var_dump($errores);
    if (empty($errores)) {
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        /* var_dump($query); */
        $resultado = mysqli_query($db,$query);
        /* var_dump($resultado); */
        if ($resultado->num_rows){
            $usuario = mysqli_fetch_assoc($resultado);
            /* var_dump($usuario); */
            $auth = password_verify($password, $usuario['password']);
            var_dump($auth);
            if($auth){
                session_start();
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = 1;
                
                header('Location: /admin');
                echo "<pre>";
                var_dump($_SESSION);
                echo "</pre>";
            }
            else{
                $errores[]= "Contraseña Incorrecta";
            }
        }else{
            $errores[]= "Email no existente";
        }
    }

}
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Conoce Sobre Nostros</h1>
    <?php  foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error?></div>
    <?php endforeach;?>
    <form action="" method="post" class="formulario" novalidate>
        <fieldset>
            <legend>Email y Password</legend>
            
            <label for="email">Email</label>
            <input type="email" placeholder="Tu Email" name="email" id="email" required>
            <label for="password">password</label>
            <input type="password" placeholder="Tu password" name="password" id="password" required>
            <input type="submit" value="Ingresar" class="boton-verde-block">
        </fieldset>
    </form>
    </div>
</main>

<?php incluir_template('footer') ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>
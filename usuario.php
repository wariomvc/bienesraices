<?php
require(__DIR__."/includes/config/database.php");
$db = conectarBD();

$email = "correo@correo.com";
$password = "12345678";
$passwordHash = password_hash($password,PASSWORD_DEFAULT);
$query =  "INSERT INTO usuarios (email, password) VALUES ('${email}', '{$passwordHash}')";
$resultado = mysqli_query($db,$query);
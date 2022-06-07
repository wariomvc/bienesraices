<?php
require 'app.php';

function incluir_template(string $nombre, $inicio = false)
{
    include TEMPLATES_URL . "$nombre.php";
}

function isAutenticado()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION['login'])){
        $logueado = $_SESSION['login'];
        if ($logueado) {
            return true;
        }
    }
    
    return false;
}

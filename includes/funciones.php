<?php
define('TEMPLATES_URL', __DIR__ . '/templates/');
define('FUNCIONES_URL2', 'funciones.php');

function incluir_template(string $nombre, $inicio = false)
{
    include TEMPLATES_URL . "$nombre.php";
}

function isAutenticado()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['login'])) {
        $logueado = $_SESSION['login'];
        if ($logueado) {
            return true;
        }
    }

    return false;
}

function s($html): string
{
    return htmlspecialchars($html);
}

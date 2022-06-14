<?php
require 'funciones.php';
require 'config/database.php';
require __DIR__.'/../vendor/autoload.php';

$db = conectarBD();

function debuguear($objeto){
    echo "<pre>";
    var_dump($objeto);
    echo "</pre>";
    exit;
}
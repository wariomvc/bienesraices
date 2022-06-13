<?php
require 'funciones.php';
require 'config/database.php';
require __DIR__.'/../vendor/autoload.php';

function debuguear($objeto){
    echo "<pre>";
    var_dump($objeto);
    echo "</pre>";
    exit;
}
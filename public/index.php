<?php
require "../includes/app.php";
use MVC\Router;
use Controller\PropiedadController;

$router = new Router;

$router->get("/",[PropiedadController::class,"index"]);
$router->get("/contacto",[PropiedadController::class,"contacto"]);
$router->get("/blog",[PropiedadController::class,"blog"]);
$router->get("/nosotros",[PropiedadController::class,"nosotros"]);
$router->get("/anuncios",[PropiedadController::class,"anuncios"]);
$router->enlazarRutas();
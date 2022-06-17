<?php
namespace Controller;

use MVC\Router;

class PropiedadController{
    public static function index(Router $router)
    {
        $parametros = ['inicio' => 'inicio'];
        $router->render('index', $parametros);
    }   
    public static function contacto(Router $router)
    {
        
        $router->render('contacto');
    }
    public static function blog(Router $router)
    {
        $router->render('blog');
    } 
    public static function nosotros(Router $router)
    {
        $router->render('nosotros');
    } 

    public static function anuncios(Router $router)
    {
        $router->render('anuncios');
    } 
}
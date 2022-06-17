<?php

namespace Controller;

use Model\Vendedor;
use MVC\Router;


class VendedoresController
{
    public static function crear(Router $router)
    {

        $db = conectarBD();

        $auth = isAutenticado();
        if (!$auth) {
            header('Location: /');
        }

        Vendedor::setDB($db);
        $vendedor = new Vendedor();
        $errores = Vendedor::getErorres();



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre_imagen = md5(uniqid(rand())) . ".jpg";
            $vendedor = new Vendedor($_POST);
            $errores = $vendedor->validar();


            $errores = $vendedor->getErorres();
            if (empty($errores)) {
                $r = $vendedor->guardar();


                //echo $query;      
                if ($r) {
                    header('Location: /admin?res=1');
                }
            }
        }
        $router->render("vendedores/crear", [
            "errores" => $errores,
            "vendedor" => $vendedor,
        ]);
    }
    public static function actualizar(Router $router)
    {
        
        $db = conectarBD();
        $auth = isAutenticado();

        if (!$auth) {
            header('Location: /');
        }

        $db = conectarBD();
        $vendedor = new Vendedor();
        Vendedor::setDB($db);


        $id_vendedor = $_GET['id'];
        $id_vendedor = filter_var($id_vendedor, FILTER_VALIDATE_INT);
        $vendedor->getById($id_vendedor);


        $errores = [];



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor->sincroniza($_POST);

            $errores = $vendedor->validar();



            if (empty($errores)) {
                $r = $vendedor->Actualizar();
                if ($r) {
                    header('Location: /admin?res=2');
                }
            }
        }
        $router->render('vendedores/actualizar',[
            "vendedor"=> $vendedor,
            "errores" => $errores,
        ]);
    }
     public static function borrar(Router $router)
    {
        
        $db = conectarBD();
        Vendedor::setDB($db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {

                $vendedor = new Vendedor();

                $vendedor->getById($id);
                $resultado = $vendedor->Borrar();
                if ($resultado) {
                    header("location: /admin?res=3");
                }
            }
        }
    }
}

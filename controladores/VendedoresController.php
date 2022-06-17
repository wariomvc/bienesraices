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
        $router->render("vendedores/crear",[
            "errores"=>$errores,
            "vendedor"=>$vendedor,
        ]);
        
    }
}

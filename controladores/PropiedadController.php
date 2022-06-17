<?php

namespace Controller;

use Model\Propiedad;
use Model\Vendedor;
use MVC\Router;


class PropiedadController
{
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
        $propiedad = new Propiedad();
        $db = conectarBD();

        /* Consultar Propiedades */
        Propiedad::setDB($db);
        $propiedades = Propiedad::getAll();
        $router->render('anuncios', ['propiedades' => $propiedades]);
    }

    public static function admin(Router $router)
    {
        $db = conectarBD();
        Propiedad::setDB($db);
        $propiedades = Propiedad::getAll();
        $vendedores = Vendedor::getAll();


        $auth = isAutenticado();


        if (!$auth) {
            header('Location: /');
        }
        /* Conectar y Consultar BD */

        /* Respuesta Condicional */
        $mensaje = "La Propiedad se ha Regisrado Exitosamente";
        $respuesta = $_GET['res'] ?? null;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
                $resultado_imagen = mysqli_query($db, $query);
                $propiedad = new Propiedad();

                $propiedad->getById($id);
                $resultado = $propiedad->Borrar();


                if ($resultado_imagen) {
                    unlink("../imagenes/" . $propiedad->imagen);
                }
                if ($resultado) {
                    header("location: /admin?res=3");
                }
            }
        }



        $router->render('admin/index', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'mensaje' => "La Propiedad se ha Regisrado Exitosamente",
        'respuesta' => $_GET['res'] ?? null,
        ]);
    }

    public static function crear(Router $router){
        
    }
}

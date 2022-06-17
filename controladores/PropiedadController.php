<?php

namespace Controller;

use Model\Propiedad;
use Model\Vendedor;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\ActiveRecord;

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

    public static function crear(Router $router)
    {
        $db = conectarBD();
        $auth = isAutenticado();
        if (!$auth) {
            header('Location: /');
        }


        $propiedad = new Propiedad();
        Vendedor::setDB($db);
        $vendedores = Vendedor::getAll();
        $errores = Propiedad::getErorres();

        $titulo = '';
        $precio = '';
        $descripcion = '';
        $habitaciones = '';
        $wc = '';
        $estacionamiento = '';
        $vendedorId = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_imagen = md5(uniqid(rand())) . ".jpg";
            $propiedad = new Propiedad($_POST);
            $errores = $propiedad->validar();
            $propiedad->setImagen($nombre_imagen, $_FILES['imagen']);

            $carpeta_imagenes = 'imagenes/';
            if (!is_dir($carpeta_imagenes)) {
            }

            $errores = $propiedad->getErorres();
            if (empty($errores)) {
                $propiedad::setDB($db);
                $r = $propiedad->guardar();
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                
                $image->save($carpeta_imagenes . $nombre_imagen);
                

                //echo $query;      
                if ($r) {
                    header('Location: /admin?res=1');
                }
            }
        }
        $router->render('admin/crear',[
            "errores"=>$errores,
            "propiedad"=>$propiedad,
            "vendedores"=>$vendedores
        ]);
    }

    public static function borrar(Router $router)
    {
        $db = conectarBD();
        Propiedad::setDB($db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                
                $propiedad = new Propiedad();
        
                $propiedad->getById($id);
                $resultado = $propiedad->Borrar();
                if ($propiedad->imagen) {
                    unlink("imagenes/" . $propiedad->imagen);
                }
                if ($resultado) {
                    header("location: /admin?res=3");
                }
            }
        }
    }

    public static function actualizar(Router $router)
    {
        
        # code...
    }
}

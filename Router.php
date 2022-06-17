<?php
namespace MVC;
use Controller\PropiedadController;


class Router{
    public  $routes = [];
    public  function get($url,$function){
        $this->routes[$url] = $function;
        
    }

    public  function enlazarRutas(){
        $url = $_SERVER['PATH_INFO'] ?? '/';
        if($_SERVER["REQUEST_METHOD"]==='GET'){
            if(isset($this->routes[$url])){
                $function = $this->routes[$url];
                call_user_func($function, $this);
            }else{
                return  "Pagina no encontrada";
            }
            
            
        }
        
        
        
    }

    public function render($vista, $parametros=[]){
        foreach ($parametros as $key => $value) {
            $$key = $value;
        }
        ob_start();
        if(include_once __DIR__.'/views/'.$vista.'.php' == TRUE){
            $contenido = ob_get_clean();
        }else{
            ob_clean();
            $contenido = "<h1>Error Vista no encontrada</h1>";
        }
        
        include_once(__DIR__.'/views/base.php');

    }
}
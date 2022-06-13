<?php

namespace App;

class Propiedad 
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio','imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $db;
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $imagen_dataform;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    protected static $errores = [];

    public function __construct($args = [], $Files=[], string $nombre_imagen = '')
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $nombre_imagen;
        $this->imagen_dataform = $Files;
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento =  $args['estacionamiento']  ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';

    }

    public static function setDB(\mysqli $db)
    {
        self::$db = $db;
    }

    public function guardar()
    {
        $atributos = $this->sanitizarAtributos();
        $string_columnas = join(',',array_keys($atributos));
        $string_valores = join("','",array_values($atributos));
        $query = "INSERT INTO propiedades ( ".$string_columnas." )";
        $query .= "VALUES ('".$string_valores."' )";
        
        $resultado = self::$db->query($query);
        return $resultado;
        
    }

    public function cargarPropiedad($id){
        $query = "SELECT * FROM  propiedades WHERE id='$id'";
        $resultado = self::$db->query($query);
        
        foreach ($resultado->fetch_assoc() as $key => $value) {
            $this->$key = $value;
        }
        


    }

    public function atributos()
    {
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna==='id') continue;
            $atributos[$columna] = $this->$columna;
            
        }
        
        return $atributos;
    }

    public function setImagen($imagen)
    {
        if($imagen){
            $this->imagen = $imagen;
        }
    }
    public function sanitizarAtributos()
    {
        $atributos =  $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public static function getErorres()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (empty($this->titulo)) {
            self::$errores[] = "Debes Añadir un Titulo";
        };
        if (empty($this->precio)) {
            self::$errores[] = "Debes Añadir un precio";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La Descripción debe contener más de 50 caracteres";
        }
        if ($this->habitaciones < 1) {
            self::$errores[] = "Debe ser por lo menos una Habitación";
        }
    
        if ($this->wc < 1) {
            self::$errores[] = "Debe ser por lo menos una WC";
        }
        if ($this->estacionamiento < 1) {
            self::$errores[] = "Debe ser por lo menos una Estacionamiento";
        }
        $size = 1000 * 100;
        
         if (!$this->imagen_dataform['size'] > $size) {
            self::$errores[] = "La imagen es muy grande ($this->imagen_dataform['size'])";
        }
        if ($this->imagen_dataform['error']) {
            switch ($this->imagen_dataform['error']) {
                case UPLOAD_ERR_NO_FILE:
                    self::$errores[]="La imagen es obligatoria.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    self::$errores[]= "Imagen Subida Parcialmente, Intenta con otra imagen";
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    self::$errores[]="Se Excedió el Tamaño Maximo del Archivo. ";
                    break;
            }
        }
        if ($this->vendedorId === "") {
            self::$errores[] = "Debe ser por lo menos una Estacionamiento";
        }
        return self::$errores;
    }
}
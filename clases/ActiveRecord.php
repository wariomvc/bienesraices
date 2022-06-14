<?php

namespace App;

class ActiveRecord
{
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $db;
    

    protected static $errores = [];

    

    public static function setDB(\mysqli $db)
    {
        self::$db = $db;
    }

    public  static function getAll()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado_consulta = self::$db->query($query);        
        while ($registro = $resultado_consulta->fetch_assoc()) {
            $arreglo[] = self::crearObjeto($registro);
        }
        $resultado_consulta->free();
        
        return $arreglo;
    }

    public static function crearObjeto($registro)
    {
        $i = 0;
        $objeto = new static;
        foreach ($registro as $key => $value) {
            $objeto->$key = $value;
        }
        return $objeto;
    }
    public function guardar()
    {
        $atributos = $this->sanitizarAtributos();
        $string_columnas = join(',', array_keys($atributos));
        $string_valores = join("','", array_values($atributos));
        $query = "INSERT INTO " . static::$tabla . " ( " . $string_columnas . " )";
        $query .= "VALUES ('" . $string_valores . "' )";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function Actualizar()
    {
        $atributos = $this->sanitizarAtributos();
        $datos_query = "";
        $arreglo_temporal = [];
        foreach ($atributos as $key => $value) {
            $arreglo_temporal[] =  "$key = '" . $value . "' ";
        }
        $datos_query = join(',', $arreglo_temporal);
        $query = "UPDATE " . static::$tabla . " SET " . $datos_query . "WHERE id ='" . $this->id . "'";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public function Borrar()
    {
        $query = "DELETE  FROM ". static::$tabla ." WHERE id = '$this->id'";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public function cargarPropiedad($id)
    {
        $query = "SELECT * FROM  ". static::$tabla ." WHERE id='$id'";
        $resultado = self::$db->query($query);
        foreach ($resultado->fetch_assoc() as $key => $value) {
            $this->$key = $value;
        }
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function setImagen($imagen, $imagen_data = [])
    {
        $size = 1000 * 100;
        if (!empty($imagen_data)) {
            # code...

            if (!$imagen_data['size'] > $size) {
                self::$errores[] = "La imagen es muy grande (" . $imagen_data['size'] . ")";
            }
            if ($imagen_data['error']) {
                switch ($imagen_data['error']) {
                    case UPLOAD_ERR_NO_FILE:
                        self::$errores[] = "La imagen es obligatoria.";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        self::$errores[] = "Imagen Subida Parcialmente, Intenta con otra imagen";
                        break;
                    case UPLOAD_ERR_INI_SIZE:
                        self::$errores[] = "Se Excedió el Tamaño Maximo del Archivo. ";
                        break;
                }
            }
        }
        if ($imagen) {
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

    public function sincroniza($datos = [])
    {

        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
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

        if ($this->vendedorId === "") {
            self::$errores[] = "Elija un Vendedor";
        }
        return self::$errores;
    }
}

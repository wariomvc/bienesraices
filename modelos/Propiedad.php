<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = "propiedades";
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = '';

        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento =  $args['estacionamiento']  ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
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

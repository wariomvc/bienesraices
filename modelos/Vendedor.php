<?php
namespace App;
class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';

    }
    public function validar()
    {
        if (empty($this->nombre)) {
            self::$errores[] = "Debes Añadir un Nombre";
        };
        if (empty($this->apellido)) {
            self::$errores[] = "Debes Añadir un apellido";
        }
        if (!preg_match('/[0-9]{10}/',$this->telefono)) {
            self::$errores[] = "El telefono debe tener al menos 10 digitos";
        }
        return self::$errores;
    }
}

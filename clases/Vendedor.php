<?php
namespace App;
class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono'];

    public $id;
    public $apellido;
    public $telefono;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->appelido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';

    }
}

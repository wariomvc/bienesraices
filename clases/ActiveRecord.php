<?php
namespace App;
class ActiveRecord
{
    protected static $DB;
    protected static $tabla = '';
    protected static $columnasDB = [];

    protected static $errores = [];

    public static function setDB($database)
    {
        self::$DB = $database;
    }

    public static function getErrores(){
        return static::$errores;
    }

    public function crear()
    {
        $query = "INSERT INTO". static::$tabla."(";
        $query .= implode(",",static::$columnasDB).")";
        $query .= "VALUES (".implode(",",static::$columnasDB).")";
    }

   
}

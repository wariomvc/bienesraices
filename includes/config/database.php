<?php

//phpinfo();
function conectarBD() : mysqli{
            $db =  new mysqli('localhost', 'root', 'zelda128', 'bienesraices',3306);
    return $db;
}
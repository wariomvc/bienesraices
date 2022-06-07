<?php

//phpinfo();
function conectarBD() : mysqli{
        $db = mysqli_connect('localhost', 'root', 'zelda128', 'bienesraices',3306);
    
    

    
    return $db;
}
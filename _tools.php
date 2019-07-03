<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=paris2;charset=utf8', 'root', 'Mylei sache1',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
    die( 'Erreur : ' . $exception->getMessage() );
}

session_start();
/*var_dump($_SESSION);*/

?>
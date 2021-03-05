<?php
    $cadena_connexio = 'mysql:dbname=imaginest;host=localhost';
    $usuari = 'root';
    $passwd = '';
    try{
        //Ens connectem a la BDs
        $db = new PDO($cadena_connexio, $usuari, $passwd);
        //Tallem la connexió a la BDs
        //$db = null;
    }catch(PDOException $e){
        echo 'Error amb la BDs: ' . $e->getMessage();
    }
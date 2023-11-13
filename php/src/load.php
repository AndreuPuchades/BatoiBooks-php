<?php
include_once($_SERVER['DOCUMENT_ROOT']."/myHelpers/utils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

spl_autoload_register( function($nombreClase) {
    $ruta = $nombreClase.'.php';
    $ruta = str_replace("BatBook", "app", $ruta);
    $ruta = str_replace("\\", "/", $ruta);
    include_once $ruta;
});

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
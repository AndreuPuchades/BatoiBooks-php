<?php
include_once('./myHelpers/utils.php');
use BatBook\User;
use BatBook\Book;
use BatBook\Module;
use BatBook\Course;

spl_autoload_register( function($nombreClase) {
    $ruta = $nombreClase.'.php';
    $ruta = str_replace("BatBook", "app", $ruta);
    $ruta = str_replace("\\", "/", $ruta);
    include_once $ruta;
});

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
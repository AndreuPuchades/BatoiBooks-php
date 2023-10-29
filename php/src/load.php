<?php
include_once('./myHelpers/utils.php');
use BatBook\User;
use BatBook\Book;
use BatBook\Module;
use BatBook\Course;

spl_autoload_register( function( $nombreClase ) {
    $ruta = $nombreClase.'.php';
    $ruta = str_replace("BatBook", "app", $ruta);
    $ruta = str_replace("\\", "/", $ruta);
    include_once $ruta;
});

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$users = isset($_SESSION['users']) ? unserialize($_SESSION['users']) : [];
$books = isset($_SESSION['books']) ? unserialize($_SESSION['books']) : [];
$modules = isset($_SESSION['modules']) ? unserialize($_SESSION['modules']) : [];
$courses = isset($_SESSION['courses']) ? unserialize($_SESSION['courses']) : [];
$statuses = isset($_SESSION['statuses']) ? unserialize($_SESSION['statuses']) : [];

$_SESSION['users'] = serialize($users);
$_SESSION['books'] = serialize($books);
$_SESSION['modules'] = serialize($modules);
$_SESSION['courses'] = serialize($courses);
$_SESSION['statuses'] = serialize($statuses);
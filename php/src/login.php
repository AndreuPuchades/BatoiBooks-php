<?php
include_once('./myHelpers/utils.php');
include_once('./load.php');

use BatBook\User;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);
    $errors = [];

    if(!isset($_POST['email'])){
        $errors['email'] = 'Debes introducir el email.';
    } else {
        $user = User::getUserEmail($_POST['email']);
        if($user == null){
            $errors['email'] = 'El email introducido no existe.';
        } else {
            if(isset($_POST['password']) && password_verify($_POST['password'], $user->getPassword())){
                $userLogin = $user;
            } else {
                $errors['password'] = 'La contraseña es incorrecta.';
            }
        }
    }

    if(!isset($_POST['password'])){
        $errors['password'] = 'Debes introducir la contraseña.';
    }

    if(empty($errors)){
        $_SESSION['userLogin'] = serialize($userLogin);
        include_once('./index.php');
    } else {
        include_once('./views/login.php');
    }
} else {
    $errors = [];
    include_once('./views/login.php');
}
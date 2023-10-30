<?php
include_once('./myHelpers/utils.php');
include_once('./load.php');

use BatBook\User;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);
    $errors = [];

    if(!isset($_POST['email'])){
        $errors['email'] = 'Debes introducir el email.';
    }

    if(!isset($_POST['password'])){
        $errors['password'] = 'Debes introducir la contraseña.';
    }

    if(!empty($users)){
        foreach ($users as $user){
            if($user->getEmail() == $_POST['email']){
                if(isset($_POST['password']) && password_verify($_POST['password'], $user->getPassword())){
                    $userLogin = $user;
                } else {
                    $errors['password'] = 'La contraseña es incorrecta.';
                }
            }
        }

        if(!isset($userLogin)){
            $errors['email'] = 'El email introducido no existe.';
        }
    } else {
        $errors['email'] = 'El email introducido no existe.';
    }

    if(empty($errors)){
        $_SESSION['userLogin'] = serialize($userLogin);
        header("Location: index.php");
    } else {
        include_once('./views/login.php');
    }
} else {
    $errors = [];
    include_once('./views/login.php');
}
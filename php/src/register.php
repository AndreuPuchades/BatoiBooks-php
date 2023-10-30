<?php
include_once 'load.php';

use BatBook\User;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);
    $errors = [];

    if(empty($_POST['nick'])){
        $errors['nick'] = 'Debes introducir el nick.';
    } else {
        if(User::getUserNick($_POST['nick']) != null){
            $errors['nick'] = 'Ya existe este nick';
        }
    }

    if(empty($_POST['email'])){
        $errors['email'] = 'Debes introducir el email.';
    } else {
        if(User::getUserEmail($_POST['email']) != null){
            $errors['email'] = 'Ya existe este email';
        }
    }

    if(empty($_POST['password'])){
        $errors['password'] = 'Debes introducir la contraseña.';
    }

    if(empty($_POST['confirm_password'])){
        $errors['confirm_password'] = 'Debes introducir el confirmar contraseña.';
    }

    if(!empty($_POST['confirm_password']) && !empty($_POST['password'])){
        if($_POST['confirm_password'] != $_POST['password']){
            $errors['password'] = 'No coincide la contraseña.';
            $errors['confirm_password'] = 'No coincide la contraseña.';
        }
    }

    if(empty($errors)){
        $userNew = new User(-1, $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['nick']);
        User::save($userNew);
        header("Location: index.php");
    } else {
        include_once('./views/register.php');
    }
} else {
    $errors = [];
    include_once('./views/register.php');
}
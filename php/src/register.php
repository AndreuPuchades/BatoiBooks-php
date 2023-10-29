<?php
include_once 'load.php';

use BatBook\User;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);
    $errors = [];

    if(empty($_POST['nick'])){
        $errors['nick'] = 'Debes introducir el nick.';
    }

    if(empty($_POST['email'])){
        $errors['email'] = 'Debes introducir el email.';
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

    if(!empty($_POST['nick']) && !empty($_POST['email'])){
        if(isset($_SESSION['users'])){
            $users = $_SESSION['users'];
            for ($i = 0; $i < count($users); $i++) {
                if($users[$i]->getNick() == $_POST['nick']){
                    $errors['nick'] = 'Ya existe este nick';
                }
                if($users[$i]->getEmail() == $_POST['email']){
                    $errors['email'] = 'Ya existe este email';
                }
            }
        }
    }

    if(empty($errors)){
        $users[] = new User(count($users), $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['nick']);
        $_SESSION['users'] = serialize($users);

        include_once "./index.php";
    } else {
        include_once('./views/register.php');
    }
} else {
    $errors = [];
    include_once('./views/register.php');
}
<?php
include_once ('./myHelpers/utils.php');
include_once ('./load.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);

    if(!isset($_POST['nick'])){
        $errors['nick'] = 'Debes introducir el nick.';
    }

    if(!isset($_POST['email'])){
        $errors['email'] = 'Debes introducir el email.';
    }

    if(!isset($_POST['password'])){
        $errors['password'] = 'Debes introducir la contraseña.';
    }

    if(!isset($_POST['confirm_password'])){
        $errors['confirm_password'] = 'Debes introducir el confirmar contraseña.';
    }

    if(isset($_POST['confirm_password']) && isset($_POST['password'])){
        if($_POST['confirm_password'] != !isset($_POST['password'])){
            $errors['password'] = 'No coincide la contraseña.';
            $errors['confirm_password'] = 'No coincide la contraseña.';
        }
    }

    if(isset($_POST['nick']) && isset($_POST['email'])){
        if(!empty($_SESSION['users'])){
            $users = $_SESSION['users'];
            foreach ($users as $user){
                if($user->getNick() == $_POST['nick']){
                    $errors['nick'] = 'Ya existe este nick';
                }
                if($user->getEmail() == $_POST['nick']){
                    $errors['email'] = 'Ya existe este email';
                }
            }
        }
    }

    if(empty($errors)){
        $_SESSION['users'][] = new User($_POST['email'], $_POST['password'], $_POST['nick']);
    } else {
        include_once ('./views/register.php');
    }
} else {
    $errors = [];
    include_once ('./views/register.php');
}
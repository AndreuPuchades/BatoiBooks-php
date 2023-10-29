<?php
include_once ('./myHelpers/utils.php');
include_once ('./load.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);

    if(!isset($_POST['email'])){
        $errors['email'] = 'Debes introducir el email.';
    }

    if(!isset($_POST['password'])){
        $errors['password'] = 'Debes introducir la contraseña.';
    }

    if(isset($_POST['password']) && isset($_POST['email'])){
        if(!isset($_SESSION['users']) && !empty($_SESSION['users'])){
            $users = $_SESSION['users'];
            foreach ($users as $user){
                if($user->getEmail() == $_POST['email']){
                    if(isset($_POST['password']) && $user->getPassword() == $_POST['password']){
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
    }

    if(empty($errors)){
        echo '<h1>Usuario: '. $userLogin->getNick(). '</h1>';
    } else {
        include_once ('./views/login.php');
    }
} else {
    $errors = [];
    include_once ('./views/login.php');
}
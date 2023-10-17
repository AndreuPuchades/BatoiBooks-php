<?php
$aficions = ['Correr', 'MTB', 'Triatlon', 'Sofa', 'Chat GPT'];
$menus = ['Borreta', 'Pericana', 'Bajoques Farcides', 'Arròs al Forn'];
$errors = [];

function printErrors($errors, $field): string{
    if(isset($errors[$field])){
        return "<span class='error'>". $errors[$field]. "</span>";
    }
    return "";
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    extract($_POST);
    echo $nom. '</br>';
    echo $cognoms. '</br>';
    echo $email. '</br>';
    echo $url. '</br>';
    echo $sexe. '</br>';

    echo 'Aficiones: </br>';
    foreach ($aficions as $key => $value){
        echo $value. '</br>';
    }

    echo 'Menus: </br>';
    foreach ($menus as $key => $value){
        echo $value. '</br>';
    }
} else {
    include_once "402.view.php";
}
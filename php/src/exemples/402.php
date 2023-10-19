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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $errors = array();

    $editorial = $_POST["publisher"];
    if (empty($editorial)) {
        $errors["publisher"] = "El camp editorial és obligatori.";
    }

    $price = $_POST["price"];
    if (empty($price)) {
        $errors["price"] = "El camp preu és obligatori.";
    }

    $pages = $_POST["pages"];
    if (empty($pages)) {
        $errors["pages"] = "El camp pàgines és obligatori.";
    }

    $module = $_POST["module"];
    $status = $_POST["status"];
} else {
    include "views/books/new.php";

}
<?php
use BatBook\exceptions\InvalidFormatException;
use BatBook\Book;
use BatBook\Module;

include_once "./load.php";

try {
    $modulesOptions = Module::getModulesInArray();
    $statusOptions = ['Good', 'Bad', 'Used', 'New'];
} catch (InvalidFormatException|Exception $e) {
    echo $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (empty($_POST["publisher"])) {
        $errors["publisher"] = "El camp editorial és obligatori.";
    }

    if (empty($_POST["price"])) {
        $errors["price"] = "El camp preu és obligatori.";
    } else if ($_POST["price"] <= 0){
        $errors["price"] = "El camp preu te que ser major a 0.";
    }

    if (empty($_POST["pages"])) {
        $errors["pages"] = "El camp pàgines és obligatori.";
    } else if ($_POST["pages"] <= 0){
        $errors["pages"] = "El camp pàgines te que ser major a 0.";
    }

    if (empty($_POST["comments"])) {
        $errors["comments"] = "El camp comentari és obligatori.";
    }

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        $photo = "photos/" . basename($_FILES["photo"]["name"]);

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $photo)) {
            $errors["photo"] = "Hubo un error al subir la imagen.";
        }
    } else {
        $errors["photo"] = "No se ha seleccionado ninguna imagen.";
    }

    if (empty($_POST["module"])) {
        $errors["module"] = "El camp modul és obligatori.";
    }

    if (empty($_POST["status"])) {
        $errors["status"] = "El camp estat és obligatori.";
    }

    if(empty($errors)){
        if(isset($_SESSION['userLogin'])){
            $idUser =  unserialize($_SESSION['userLogin'])->getId();
            $book = new Book(-1, $idUser, $module, $publisher, $price, $pages, $status, $photo, $comments);
            Book::save($book);
        }

        include_once "./views/book.php";
    } else {
        include_once "./views/newBook.php";
    }
} else {
    $errors = [];
    include "./views/newBook.php";
}
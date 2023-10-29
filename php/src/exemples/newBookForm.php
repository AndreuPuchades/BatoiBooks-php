<?php
include_once('../modelos/Book.php');
include_once('../modelos/Module.php');
include ("./myHelpers/utils.php");

try {
    $modulesOptions = Module::importModuleFromCSV('../csv/modulesbook.csv');
    $statusOptions = ['Good', 'Bad'];
} catch (InvalidFormatException $e) {
    echo $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (empty($_POST["publisher"])) {
        $errors["publisher"] = "El camp editorial és obligatori.";
    }

    if (empty($_POST["price"])) {
        $errors["price"] = "El camp preu és obligatori.";
    }

    if (empty($_POST["pages"])) {
        $errors["pages"] = "El camp pàgines és obligatori.";
    }

    if (empty($_POST["comments"])) {
        $errors["comments"] = "El camp comentari és obligatori.";
    }

    if (empty($_POST["photo"])) {
        $errors["photo"] = "El camp foto és obligatori.";
    }

    if (empty($_POST["module"])) {
        $errors["module"] = "El camp modul és obligatori.";
    }

    if (empty($_POST["status"])) {
        $errors["status"] = "El camp estat és obligatori.";
    }

    if(empty($errors)){
        $book = new Book(0, $module, $publisher, $price, $pages, $status, $photo, $comments);

        echo 'Id del usuari: '. $book->getIdUser(). '</br>';
        echo 'Id del modul: '. $book->getIdModule(). '</br>';
        echo 'Editorial: '. $book->getPublisher(). '</br>';
        echo 'Preu: '. $book->getPrice(). '</br>';
        echo 'Pagines: '. $book->getPages(). '</br>';
        echo 'Estat: '. $book->getStatus(). '</br>';
        echo 'Foto: '. $book->getPhoto(). '</br>';
        echo 'Comentari: '. $book->getComments(). '</br>';
        echo 'SoldDate: '. $book->getSoldDate(). '</br>';
    } else {
        include "./views/newBook.php";
    }
} else {
    $errors = [];
    include "./views/newBook.php";
}
<?php
use BatBook\exceptions\InvalidFormatException;
use BatBook\Book;
use BatBook\Module;

include_once "./load.php";

try {
    $modulesOptions = Module::importModuleFromCSV('./csv/modulesbook.csv');
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
/*
    if ($_FILES["photo"] != "") {
        $nombreArchivo = $_FILES["photo"]["name"];
        $rutaTemporal = $_FILES["photo"]["tmp_name"];

        $rutaCompleta = "./photos/" . $nombreArchivo;

        if (move_uploaded_file($rutaTemporal, $rutaCompleta)) {
            $errors["photo"] = "La imagen se ha cargado exitosamente.";
        } else {
            echo "Error al cargar la imagen.";
        }
    } else {
        $errors["photo"] = "El camp foto és obligatori.";
    }
*/
    if (empty($_POST["module"])) {
        $errors["module"] = "El camp modul és obligatori.";
    }

    if (empty($_POST["status"])) {
        $errors["status"] = "El camp estat és obligatori.";
    }

    if(empty($errors)){
        if(!isset($_SESSION['userLogin'])){
            $book = new Book(-1, $module, $publisher, $price, $pages, $status, $photo, $comments);
            $books[] = serialize($book);
        } else {
            $idUser =  unserialize($_SESSION['userLogin'])->getId();
            $book = new Book($idUser, $module, $publisher, $price, $pages, $status, $photo, $comments);
            $books[] = $book;
        }

        $_SESSION['books'] = serialize($books);

        include_once "./views/book.php";
    } else {
        include_once "./views/newBook.php";
    }
} else {
    $errors = [];
    include "./views/newBook.php";
}
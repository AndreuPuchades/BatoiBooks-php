<?php
use BatBook\Book;

include_once "./load.php";
if (isset($_SESSION['userLogin'])) {
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
            $idUser =  unserialize($_SESSION['userLogin'])->getId();
            $book = new Book($_POST["id"], $idUser, $family, $publisher, $price, $pages, $status, $photo, $comments);
            Book::update($book);
            header("Location: myBooks.php");
        } else {
            $id = $_POST["id"];
            foreach (Book::getAllBooks() as $book){
                if($book->getId() == $id){
                    include_once "./views/editBook.php";
                    return;
                }
            }
        }
    } else {
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            extract($_GET);
            $id = $_GET["id"];
            foreach (Book::getAllBooks() as $book){
                if($book->getId() == $id){
                    include_once "./views/editBook.php";
                    return;
                }
            }
        }

        include_once "./myBooks.php";
    }
} else {
    header("Location: login.php");
}
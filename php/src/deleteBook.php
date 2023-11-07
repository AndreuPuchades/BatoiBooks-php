<?php
include_once "load.php";
use BatBook\Book;

if (isset($_SESSION['userLogin'])) {
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        extract($_GET);
        $idBook = $_GET["id"];
        Book::deleteBook($idBook);
    }
    header("Location: myBooks.php");
} else {
    header("Location: login.php");
}
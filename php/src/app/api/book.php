<?php
include_once "../../load.php";

use BatBook\Book;
use BatBook\exceptions\InvalidFormatException;
use BatBook\exceptions\NotFoundException;

try{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $idBook = $_GET["id"];

        if(isset($idBook)){
            $book = Book::getBookById($idBook);
            if($book){
                $jsonBook = $book->__toJson();
                echo $jsonBook;
                return $jsonBook;
            } else {
                throw new InvalidFormatException("El id del llibre no es valid.");
            }
        } else {
            throw new NotFoundException("No es pasen el valor de id del llibre");
        }
    } else {
        throw new NotFoundException("No es pasen els valor per el GET");
    }
} catch (NotFoundException | InvalidFormatException $e){
    echo $e->getMessage();
}
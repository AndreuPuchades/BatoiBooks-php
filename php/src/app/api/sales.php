<?php
include_once "../../load.php";

use BatBook\Book;
use BatBook\exceptions\NotFoundException;
use BatBook\Sales;
use BatBook\User;

header("Content-Type:application/json");
try{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["idBook"])){
            $book = Book::getBookById($_POST["idBook"]);
            if(!$book){
                throw new NotFoundException("La id del libro no existe.");
            } else {
                if($book->getSoldDate() !== null){
                    throw new NotFoundException("El libro seleccionado ya esta vendido.");
                }
            }
        } else {
            throw new NotFoundException("No se pasan los valores de idBook por POST");
        }

        if(isset($_POST["idUser"])){
            $user = User::getUserId($_POST["idUser"]);
            if(!$user){
                throw new NotFoundException("La id del usuario no existe.");
            }
        } else {
            throw new NotFoundException("No se pasan los valores de IdUser por POST");
        }

        $book->setSoldDate(date_format(new DateTime(), "Y-m-d H:i:s"));
        Book::update($book);
        $sale = new Sales($book->getId(), $user->getId());
        $sale = $sale->save();
        echo $sale->__toJson();
        return $sale->__toJson();
    } else {

        throw new NotFoundException("No se pasan valores por el POST");
    }
} catch (NotFoundException $e){
    echo $e->getMessage();
}
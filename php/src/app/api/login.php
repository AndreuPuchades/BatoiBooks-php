<?php
include_once "../../load.php";

use BatBook\exceptions\InvalidFormatException;
use BatBook\exceptions\NotFoundException;
use BatBook\User;

try{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(isset($email) && isset($password)){
            $user = User::getUserEmail($email);
            if(password_verify($_POST['password'], $user->getPassword())){
                $jsonUser = $user->__toJson();
                echo $jsonUser;
                return $jsonUser;
            } else {
                throw new InvalidFormatException("Els valors email y user no son valids.");
            }
        } else {
            throw new NotFoundException("No se pasan los valores de email y user");
        }
    } else {
        throw new NotFoundException("No se pasan los valores por el POST");
    }
} catch (NotFoundException | InvalidFormatException $e){
    echo $e->getMessage();
}
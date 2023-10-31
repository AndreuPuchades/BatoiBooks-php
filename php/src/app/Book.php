<?php
namespace BatBook;

use PDO;
use PDOException;

class Book{
    private $id;
    private $idUser;
    private $idModule;
    private $publisher;
    private $price;
    private $pages;
    private $status;
    private $photo;
    private $comments;
    private $soldDate;

    public function __construct($id, $idUser, $idModule, $publisher, $price, $pages, $status, $photo, $comments, $soldDate = "")
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->idModule = $idModule;
        $this->publisher = $publisher;
        $this->price = $price;
        $this->pages = $pages;
        $this->status = $status;
        $this->photo = $photo;
        $this->comments = $comments;
        $this->soldDate = $soldDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function getIdModule()
    {
        return $this->idModule;
    }

    public function setIdModule($idModule)
    {
        $this->idModule = $idModule;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function getSoldDate()
    {
        return $this->soldDate;
    }

    public function getSoldDateForm()
    {
        return !isset($this->soldDate) ? "No esta vendido" : $this->soldDate;
    }

    public function setSoldDate($soldDate)
    {
        $this->soldDate = $soldDate;
    }

    public function markAsSold()
    {
        $this->status = 'sold';
        $this->soldDate = date('Y-m-d');
    }

    public function __toString()
    {
        return "Book [idUser=$this->idUser, idModule=$this->idModule, publisher=$this->publisher, price=$this->price, pages=$this->pages, status=$this->status, photo=$this->photo, comments=$this->comments, soldDate=$this->soldDate]";
    }

    public function __toJson()
    {
        return json_encode([
            'idUser' => $this->idUser,
            'idModule' => $this->idModule,
            'publisher' => $this->publisher,
            'price' => $this->price,
            'pages' => $this->pages,
            'status' => $this->status,
            'photo' => $this->photo,
            'comments' => $this->comments,
            'soldDate' => $this->soldDate
        ]);
    }

    public static function save($book) {
        $conexionNew = new Connection();
        $conexion = $conexionNew->getConnection();
        $sql = "INSERT INTO books (idUser, idModule, publisher, price, pages, status, photo, comments, soldDate) VALUES (:idUser, :idModule, :publisher, :price, :pages, :status, :photo, :comments, :soldDate)";
        $variables = $conexion->prepare($sql);
        $idUser = $book->getIdUser();
        $idModule = $book->getIdModule();
        $publisher = $book->getPublisher();
        $price = $book->getPrice();
        $pages = $book->getPages();
        $status = $book->getStatus();
        $photo = $book->getPhoto();
        $comments = $book->getComments();
        $soldDate = $book->getSoldDate();
        if($soldDate !== ''){
            $soldDate = date_format(date_create($soldDate), 'Y-m-d');
        } else {
            $soldDate = null;
        }

        $variables->bindParam(':idUser', $idUser);
        $variables->bindParam(':idModule', $idModule);
        $variables->bindParam(':publisher', $publisher);
        $variables->bindParam(':price', $price);
        $variables->bindParam(':pages', $pages);
        $variables->bindParam(':status', $status);
        $variables->bindParam(':photo', $photo);
        $variables->bindParam(':comments', $comments);
        $variables->bindParam(':soldDate', $soldDate);

        $variables->execute();
        return $conexion->lastInsertId();
    }

    public static function getAllBooks(): ?array
    {
        $conexionNew = new Connection();
        $conexion = $conexionNew->getConnection();
        $sql = "select * from books";
        $data = [];

        try{
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> setFetchMode(PDO::FETCH_ASSOC);
            $sentencia -> execute();

            while($fila = $sentencia -> fetch()){
                $data[] = self::getBookForm($fila);
            }

            return $data;
        }catch(PDOException $e) {
            echo $e -> getMessage();
        }

        return null;
    }

    private static function getBookForm($libro): ?Book{
        if($libro){
            return new Book($libro["id"], $libro["idUser"], $libro["idModule"], $libro["publisher"], $libro["price"],
                $libro["pages"], $libro["status"], $libro["photo"], $libro["comments"], $libro["soldDate"]);
        } else {
            return null;
        }
    }
}
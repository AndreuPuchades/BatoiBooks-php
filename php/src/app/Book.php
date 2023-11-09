<?php
namespace BatBook;
use BatBook\QueryBuilder;
use PDO;
use PDOException;

class Book{
    public static $nameTable = "books";
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

    public function __construct($id = '', $idUser = '', $idModule = '', $publisher = '', $price = '', $pages = '',
                                $status = '', $photo = '', $comments = '', $soldDate = '')
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
            'id' => $this->id,
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

    public function getFormArray(){
        return ['idUser' => $this->idUser, 'idModule' => $this->idModule, 'publisher' => $this->publisher,
            'price' => $this->price, 'pages' => $this->pages, 'status' => $this->status, 'photo' => $this->photo,
            'comments' => $this->comments, 'soldDate' => $this->soldDate];
    }

    public function getFormArrayUpdate(){
        return ['id' => $this->id, 'idUser' => $this->idUser, 'idModule' => $this->idModule, 'publisher' => $this->publisher,
            'price' => $this->price, 'pages' => $this->pages, 'status' => $this->status, 'photo' => $this->photo,
            'comments' => $this->comments, 'soldDate' => $this->soldDate];
    }

    public static function save($book) {
        return QueryBuilder::insert(Book::class, $book->getFormArray());
    }

    public static function getAllBooks()
    {
        return QueryBuilder::sql(Book::class);
    }

    public static function getBookByIdUser($idUser)
    {
        return QueryBuilder::sql(Book::class, ["idUser" => $idUser]);
    }

    public static function getBookById($id)
    {
        return QueryBuilder::sql(Book::class, ["id" => $id]);
    }

    public static function deleteBook($idBook): bool
    {
        return QueryBuilder::delete(Book::class, $idBook);
    }

    public static function update($book)
    {
        QueryBuilder::update(Book::class, $book->getFormArrayUpdate(), $book->getId());
    }
}
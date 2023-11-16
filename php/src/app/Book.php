<?php
namespace BatBook;
use BatBook\QueryBuilder;
use PDO;
use PDOException;

/**
 *
 */
class Book{
    /**
     * @var string
     */
    public static $nameTable = "books";
    /**
     * @var mixed|string
     */
    private $id;
    /**
     * @var mixed|string
     */
    private $idUser;
    /**
     * @var mixed|string
     */
    private $idModule;
    /**
     * @var mixed|string
     */
    private $publisher;
    /**
     * @var mixed|string
     */
    private $price;
    /**
     * @var mixed|string
     */
    private $pages;
    /**
     * @var mixed|string
     */
    private $status;
    /**
     * @var mixed|string
     */
    private $photo;
    /**
     * @var mixed|string
     */
    private $comments;
    /**
     * @var mixed|string
     */
    private $soldDate;

    /**
     * @param $id
     * @param $idUser
     * @param $idModule
     * @param $publisher
     * @param $price
     * @param $pages
     * @param $status
     * @param $photo
     * @param $comments
     * @param $soldDate
     */
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

    /**
     * @return mixed|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param $idUser
     * @return void
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed|string
     */
    public function getIdModule()
    {
        return $this->idModule;
    }

    /**
     * @param $idModule
     * @return void
     */
    public function setIdModule($idModule)
    {
        $this->idModule = $idModule;
    }

    /**
     * @return mixed|string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param $publisher
     * @return void
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed|string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed|string
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param $pages
     * @return void
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed|string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param $photo
     * @return void
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed|string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param $comments
     * @return void
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed|string
     */
    public function getSoldDate()
    {
        return $this->soldDate;
    }

    /**
     * @return mixed|string
     */
    public function getSoldDateForm()
    {
        return !isset($this->soldDate) ? "No esta vendido" : $this->soldDate;
    }

    /**
     * @param $soldDate
     * @return void
     */
    public function setSoldDate($soldDate)
    {
        $this->soldDate = $soldDate;
    }

    /**
     * @return void
     */
    public function markAsSold()
    {
        $this->status = 'sold';
        $this->soldDate = date('Y-m-d');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Book [idUser=$this->idUser, idModule=$this->idModule, publisher=$this->publisher, price=$this->price, pages=$this->pages, status=$this->status, photo=$this->photo, comments=$this->comments, soldDate=$this->soldDate]";
    }

    /**
     * @return false|string
     */
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

    /**
     * @return array
     */
    public function getFormArray(){
        return ['idUser' => $this->idUser, 'idModule' => $this->idModule, 'publisher' => $this->publisher,
            'price' => $this->price, 'pages' => $this->pages, 'status' => $this->status, 'photo' => $this->photo,
            'comments' => $this->comments, 'soldDate' => $this->soldDate];
    }

    /**
     * @return array
     */
    public function getFormArrayUpdate(){
        return ['id' => $this->id, 'idUser' => $this->idUser, 'idModule' => $this->idModule, 'publisher' => $this->publisher,
            'price' => $this->price, 'pages' => $this->pages, 'status' => $this->status, 'photo' => $this->photo,
            'comments' => $this->comments, 'soldDate' => $this->soldDate];
    }

    /**
     * @param $book
     * @return false|string
     */
    public static function save($book) {
        return QueryBuilder::insert(Book::class, $book->getFormArray());
    }

    /**
     * @return array|false
     */
    public static function getAllBooks()
    {
        return QueryBuilder::sql(Book::class);
    }

    /**
     * @param $idUser
     * @return array|false
     */
    public static function getBookByIdUser($idUser)
    {
        return QueryBuilder::sql(Book::class, ["idUser" => $idUser]);
    }

    /**
     * @param $id
     * @return array|false
     */
    public static function getBookById($id)
    {
        $book = QueryBuilder::sql(Book::class, ["id" => $id]);
        return $book[0] ?? null;
    }

    /**
     * @param $idBook
     * @return bool
     */
    public static function deleteBook($idBook): bool
    {
        return QueryBuilder::delete(Book::class, $idBook);
    }

    /**
     * @param $book
     * @return void
     */
    public static function update($book)
    {
        QueryBuilder::update(Book::class, $book->getFormArrayUpdate(), $book->getId());
    }
}
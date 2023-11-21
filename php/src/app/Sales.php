<?php
namespace BatBook;

class Sales{
    public static $nameTable = "sales";
    private $id;
    private $idBook;
    private $idUser;

    public function __construct($idbook = "", $idUser = "")
    {
        $this->idBook = $idbook;
        $this->idUser = $idUser;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUser(){
        return User::getUserId($this->idUser);
    }

    public function getBook(){
        return Book::getBookById($this->idBook);
    }

    public function save(){
        $id = QueryBuilder::insert(Sales::class, $this->getFormArray());
        $sale = new Sales($this->idBook, $this->idUser);
        $sale->setId($id);
        return $sale;
    }

    public function delete(){
        return QueryBuilder::delete(Sales::class, $this->id);
    }

    public static function getSales($idUser){
        return QueryBuilder::sql(Book::class, ["idUser" => $idUser]);
    }

    public function getFormArray(){
        return ["idBook" => $this->idBook, "idUser" => $this->idUser, "date" => null, "status" => null];
    }

    public function __toJson()
    {
        return json_encode([
            'id' => $this->id,
            'idBook' => $this->idBook,
            'idUser' => $this->idUser,
            'date' => null,
            'status' => null
        ]);
    }
}
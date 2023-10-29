<?php
namespace BatBook;
class Book{
    private $idUser;
    private $idModule;
    private $publisher;
    private $price;
    private $pages;
    private $status;
    private $photo;
    private $comments;
    private $soldDate;

    public function __construct($idUser, $idModule, $publisher, $price, $pages, $status, $photo, $comments, $soldDate = false)
    {
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
}
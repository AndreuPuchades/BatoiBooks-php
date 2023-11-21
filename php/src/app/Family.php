<?php
namespace BatBook;
use BatBook\QueryBuilder;

class Family{
    public static $nameTable = "families";
    private $id;
    private $cliteral;
    private $vlieral;

    public function __construct($id = "", $cliteral = "", $vlieral = "")
    {
        $this->id = $id;
        $this->cliteral = $cliteral;
        $this->vlieral = $vlieral;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCliteral()
    {
        return $this->cliteral;
    }

    public function getVlieral()
    {
        return $this->vlieral;
    }

    public static function getFamilyById($id){
        $family = QueryBuilder::sql(Family::class, ["id" => $id]);
        return $family[0] ?? null;
    }
}
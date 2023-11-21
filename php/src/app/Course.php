<?php
namespace BatBook;
use BatBook\exceptions\InvalidFormatException;

class Course{
    public static $nameTable = "courses";
    private $id;
    private $cycle;
    private $idFamily;
    private $vliteral;
    private $cliteral;

    public function __construct($id ="", $cycle = '', $idFamily = '', $vliteral = '', $cliteral = '')
    {
        $this->id = $id;
        $this->cycle = $cycle;
        $this->idFamily = $idFamily;
        $this->vliteral = $vliteral;
        $this->cliteral = $cliteral;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCycle()
    {
        return $this->cycle;
    }

    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    public function getIdFamily()
    {
        return $this->idFamily;
    }

    public function setIdFamily($idFamily)
    {
        $this->idFamily = $idFamily;
    }

    public function getVliteral()
    {
        return $this->vliteral;
    }

    public function setVliteral($vliteral)
    {
        $this->vliteral = $vliteral;
    }

    public function getCliteral()
    {
        return $this->cliteral;
    }

    public function setCliteral($cliteral)
    {
        $this->cliteral = $cliteral;
    }

    public function __toString()
    {
        return "Course [cycle=$this->cycle, idFamily=$this->idFamily, vliteral=$this->vliteral, cliteral=$this->cliteral]";
    }

    public function __toJson()
    {
        return json_encode([
            'cycle' => $this->cycle,
            'idFamily' => $this->idFamily,
            'vliteral' => $this->vliteral,
            'cliteral' => $this->cliteral
        ]);
    }

    public function getFormArrayUpdate(){
        return ['id' => $this->id, 'idFamily' => $this->idFamily, 'vliteral' => $this->vliteral, 'cliteral' => $this->cliteral];
    }

    public static function getCoursesAll(){
        return QueryBuilder::sql(Course::class);
    }

    public static function getCourseId($id){
        $course = QueryBuilder::sql(Course::class, ["id" => $id]);
        return $course[0] ?? null;
    }

    public static function delete($id){
        return QueryBuilder::delete(Course::class, $id);
    }

    public static function update($course)
    {
        QueryBuilder::update(Course::class, $course->getFormArrayUpdate(), $course->getId());
    }
}
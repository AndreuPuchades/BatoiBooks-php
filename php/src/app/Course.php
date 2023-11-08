<?php
namespace BatBook;
use BatBook\exceptions\InvalidFormatException;

class Course{
    private $cycle;
    private $idFamily;
    private $vliteral;
    private $cliteral;

    public function __construct($cycle = '', $idFamily = '', $vliteral = '', $cliteral = '')
    {
        $this->cycle = $cycle;
        $this->idFamily = $idFamily;
        $this->vliteral = $vliteral;
        $this->cliteral = $cliteral;
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
}
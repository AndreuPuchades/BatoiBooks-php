<?php
namespace BatBook;
use BatBook\exceptions\InvalidFormatException;

/**
 *
 */
class Course{
    /**
     * @var mixed|string
     */
    private $cycle;
    /**
     * @var mixed|string
     */
    private $idFamily;
    /**
     * @var mixed|string
     */
    private $vliteral;
    /**
     * @var mixed|string
     */
    private $cliteral;

    /**
     * @param $cycle
     * @param $idFamily
     * @param $vliteral
     * @param $cliteral
     */
    public function __construct($cycle = '', $idFamily = '', $vliteral = '', $cliteral = '')
    {
        $this->cycle = $cycle;
        $this->idFamily = $idFamily;
        $this->vliteral = $vliteral;
        $this->cliteral = $cliteral;
    }

    /**
     * @return mixed|string
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param $cycle
     * @return void
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * @return mixed|string
     */
    public function getIdFamily()
    {
        return $this->idFamily;
    }

    /**
     * @param $idFamily
     * @return void
     */
    public function setIdFamily($idFamily)
    {
        $this->idFamily = $idFamily;
    }

    /**
     * @return mixed|string
     */
    public function getVliteral()
    {
        return $this->vliteral;
    }

    /**
     * @param $vliteral
     * @return void
     */
    public function setVliteral($vliteral)
    {
        $this->vliteral = $vliteral;
    }

    /**
     * @return mixed|string
     */
    public function getCliteral()
    {
        return $this->cliteral;
    }

    /**
     * @param $cliteral
     * @return void
     */
    public function setCliteral($cliteral)
    {
        $this->cliteral = $cliteral;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Course [cycle=$this->cycle, idFamily=$this->idFamily, vliteral=$this->vliteral, cliteral=$this->cliteral]";
    }

    /**
     * @return false|string
     */
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
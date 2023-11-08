<?php
namespace BatBook;
use BatBook\Connection;
use BatBook\exceptions\InvalidFormatException;
use Exception;
use PDO;
use PDOException;

class Module{
    public static $nameTable = "modules";
    private $code;
    private $cliteral;
    private $vliteral;
    private $idCycle;

    public function __construct($code = '', $cliteral = '', $vliteral = '', $idCycle = '')
    {
        $this->code = $code;
        $this->cliteral = $cliteral;
        $this->vliteral = $vliteral;
        $this->idCycle = $idCycle;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): void
    {
        $this->code = $code;
    }

    public function getCliteral()
    {
        return $this->cliteral;
    }

    public function setCliteral($cliteral): void
    {
        $this->cliteral = $cliteral;
    }

    public function getVliteral()
    {
        return $this->vliteral;
    }

    public function setVliteral($vliteral): void
    {
        $this->vliteral = $vliteral;
    }

    public function getIdCycle()
    {
        return $this->idCycle;
    }

    public function setIdCycle($idCycle): void
    {
        $this->idCycle = $idCycle;
    }

    public function __toString()
    {
        return "Module [code=$this->code, cliteral=$this->cliteral, vliteral=$this->vliteral, idCycle=$this->idCycle]";
    }

    public function __toJason(){
        return json_decode(['code'=>$this->code, 'cliteral'=>$this->cliteral, 'vliteral'=>$this->vliteral, 'idCycle'=>$this->idCycle]);
    }

    public static function getModulesInArray() {
        return QueryBuilder::sql(Module::class);
    }

    public static function getModuleCode($idModule){
        return QueryBuilder::find(Module::class, "code", $idModule);
    }
}
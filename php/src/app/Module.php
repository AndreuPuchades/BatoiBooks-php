<?php
namespace BatBook;
use BatBook\Connection;
use BatBook\exceptions\InvalidFormatException;
use Exception;
use PDO;
use PDOException;

/**
 *
 */
class Module{
    /**
     * @var string
     */
    public static $nameTable = "modules";
    /**
     * @var mixed|string
     */
    private $code;
    /**
     * @var mixed|string
     */
    private $cliteral;
    /**
     * @var mixed|string
     */
    private $vliteral;
    /**
     * @var mixed|string
     */
    private $idCycle;

    /**
     * @param $code
     * @param $cliteral
     * @param $vliteral
     * @param $idCycle
     */
    public function __construct($code = '', $cliteral = '', $vliteral = '', $idCycle = '')
    {
        $this->code = $code;
        $this->cliteral = $cliteral;
        $this->vliteral = $vliteral;
        $this->idCycle = $idCycle;
    }

    /**
     * @return mixed|string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code
     * @return void
     */
    public function setCode($code): void
    {
        $this->code = $code;
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
    public function setCliteral($cliteral): void
    {
        $this->cliteral = $cliteral;
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
    public function setVliteral($vliteral): void
    {
        $this->vliteral = $vliteral;
    }

    /**
     * @return mixed|string
     */
    public function getIdCycle()
    {
        return $this->idCycle;
    }

    /**
     * @param $idCycle
     * @return void
     */
    public function setIdCycle($idCycle): void
    {
        $this->idCycle = $idCycle;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Module [code=$this->code, cliteral=$this->cliteral, vliteral=$this->vliteral, idCycle=$this->idCycle]";
    }

    /**
     * @return mixed
     */
    public function __toJason(){
        return json_decode(['code'=>$this->code, 'cliteral'=>$this->cliteral, 'vliteral'=>$this->vliteral, 'idCycle'=>$this->idCycle]);
    }

    /**
     * @return array|false
     */
    public static function getModulesInArray() {
        return QueryBuilder::sql(Module::class);
    }

    /**
     * @param $idModule
     * @return mixed
     */
    public static function getModuleCode($idModule){
        return QueryBuilder::find(Module::class, "code", $idModule);
    }
}
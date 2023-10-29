<?php
namespace BatBook;
use BatBook\exceptions\InvalidFormatException;

class Module
{
    private $code;
    private $cliteral;
    private $vliteral;
    private $idCycle;

    public function __construct($code, $cliteral, $vliteral, $idCycle)
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

    public static function importModuleFromCSV($file){
        $data = [];

        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($row) !== 4) {
                    throw new InvalidFormatException("Formato de fila inválido en el archivo CSV.");
                }
                $data[] = new Module(str_replace('"', "", $row[0]), str_replace('"', "", $row[1]),
                    str_replace('"', "", $row[2]), str_replace('"', "", $row[3]));
            }
            fclose($handle);
        } else {
            throw new InvalidFormatException("No funciona el CSV.");
        }

        return $data;
    }
}
<?php
namespace BatBook;
use BatBook\Connection;
use BatBook\exceptions\InvalidFormatException;
use Exception;
use PDO;
use PDOException;

class Module{
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

    public static function getModulesInArray() {
        $data = [];

        try {
            $conexionNew = new Connection();
            $conexion = $conexionNew->getConnection();
            $sql="SELECT * FROM modules";

            $sentencia = $conexion -> prepare($sql);
            $sentencia -> setFetchMode(PDO::FETCH_OBJ);
            $sentencia -> execute();

            while($t = $sentencia -> fetch()) {
                $data[] = new Module($t -> code,  $t -> cliteral, $t -> vliteral, $t -> idCycle);
            }
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }

        return $data;
    }
}

/*
public function importModules(){
    $data = [];

    $sql = "SELECT * FROM modules";
    $sentencia = $this->connection->prepare($sql);

    $sentencia -> setFetchMode(PDO::FETCH_CLASS, "Modules");
    $sentencia -> execute();

    while($t = $sentencia -> fetch()) {
        $data[] = new Module($t -> getCode(), $t -> getCliteral(), $t -> getVliteral(), $t -> getIdCycle());
    }

    return $data;
}
*/
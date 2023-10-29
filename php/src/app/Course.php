<?php
namespace BatBook;

use BatBook\exceptions\InvalidFormatException;

class Course{
    private $cycle;
    private $idFamily;
    private $vliteral;
    private $cliteral;

    public function __construct($cycle, $idFamily, $vliteral, $cliteral)
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

    public static function importCourseFromCSV($file): array{
        $data = [];

        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($row) !== 5) {
                    throw new InvalidFormatException("Formato de fila inválido en el archivo CSV.");
                }
                $data[] = new Course(str_replace('"', "", $row[1]), str_replace('"', "", $row[2]),
                    str_replace('"', "", $row[3]), str_replace('"', "", $row[4]));
            }
            fclose($handle);
        } else {
            throw new InvalidFormatException("No funciona el CSV.");
        }

        return $data;
    }
}

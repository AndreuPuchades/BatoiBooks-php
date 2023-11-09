<?php
namespace BatBook;

use Error;
use PDO;
use PDOException;

class QueryBuilder
{

    public static function sql($class, $values=null, $limit = null, $offset = null)
    {
        $table = $class::$nameTable;
        $conn = (new Connection)->getConnection();
        $sql = "SELECT * FROM $table";

        if ($values) {
            $sql .= " WHERE ";
            foreach (array_keys($values) as $key => $id) {
                if ($key != 0) {
                    $sql .= " AND $id=:$id";
                } else {
                    $sql .= "$id=:$id";
                }
            }
        }

        if (isset($limit) && isset($offset)) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        $sentence = $conn->prepare($sql);

        foreach ($values??[] as $key => $value) {
            $sentence->bindValue(":$key", $value);
        }

        $sentence -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $class);
        $sentence -> execute();

        return  $sentence->fetchAll();
    }

    public static function find($class, $name, $value) {
        $table = $class::$nameTable;
        $conn = (new Connection)->getConnection();

        $sql = "SELECT * FROM $table WHERE ". $name. "=:". $name;

        $statement = $conn->prepare($sql);
        $nombre = ':'. $name;
        $statement->bindValue($nombre, $value);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        $statement->execute();
        return $statement->fetch();
    }

    public static function insert($class, $values)
    {
        $table = $class::$nameTable;
        $conn = (new Connection)->getConnection();
        $sql = "INSERT INTO $table (";
        foreach (array_keys($values) as $key => $id) {
            if ($key != 0) {
                $sql .= ','.$id;
            } else {
                $sql .= $id;
            }
        }
        $sql .= ") VALUES (";
        foreach (array_keys($values) as $key => $id) {
            if ($key != 0) {
                $sql .= ',:'.$id;
            } else {
                $sql .= ':'.$id;
            }
        }
        $sql .= ")";
        $sentence = $conn->prepare($sql);
        foreach ($values as $key => $value) {
            if($key == "soldDate"){
                if($value == "" || $value == "null"){
                    $sentence->bindValue(":$key", null);
                } else {
                    $date = date("Y-m-d", strtotime($value));
                    $sentence->bindValue(":$key", $date);
                }
            } else {
                $sentence->bindValue(":$key", $value);
            }
        }
        $sentence -> execute();
        return $conn->lastInsertId();
    }

    public static function update($class, $values, $id)
    {
        $table = $class::$nameTable;
        $conn = (new Connection)->getConnection();
        $sql = "UPDATE $table SET ";
        foreach (array_keys($values) as $key => $value) {
            if ($key != 0) {
                $sql .= ','.$value.'=:'.$value;
            } else {
                $sql .= $value.'=:'.$value;
            }
        }
        $sql .= " WHERE id=:id";
        $sentence = $conn->prepare($sql);
        foreach ($values as $key => $value) {
            if($key == "soldDate"){
                if($value == "" || $value == "null"){
                    $sentence->bindValue(":$key", null);
                } else {
                    $date = date("Y-m-d", strtotime($value));
                    $sentence->bindValue(":$key", $date);
                }
            } else {
                $sentence->bindValue(":$key", $value);
            }
        }
        $sentence -> execute();
        return $id;
    }

    public static function delete($class, $id)
    {
        $table = $class::$nameTable;
        $conn = (new Connection)->getConnection();
        $sql = "DELETE FROM $table WHERE id = :id";
        $sentencia = $conn -> prepare($sql);
        $sentencia -> bindParam(":id", $id);
        return $sentencia -> execute();
    }
}
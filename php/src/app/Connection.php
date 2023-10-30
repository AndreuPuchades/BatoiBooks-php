<?php

namespace BatBook;
use PDO;
use PDOException;

include_once($_SERVER['DOCUMENT_ROOT']."/config/database.inc.php");

class Connection{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(NAME_SERVER, USER_SERVER, PASSWORD_SERVER);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de connexió a la base de dades: " . $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
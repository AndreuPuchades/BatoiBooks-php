<?php
namespace BatBook;
use PDO;
use PDOException;

include_once($_SERVER['DOCUMENT_ROOT']."/config/database.inc.php");

/**
 *
 */
class Connection{
    /**
     * @var PDO
     */
    private $connection;

    /**
     *
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO(NAME_SERVER, USER_SERVER, PASSWORD_SERVER);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de connexió a la base de dades: " . $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * @param $table
     * @param $data
     * @return false|string
     */
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table (" . $columns . ") VALUES (" . $placeholders . ")";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        return $this->connection->lastInsertId();
    }
}
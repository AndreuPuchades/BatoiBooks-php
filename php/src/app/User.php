<?php
namespace BatBook;
use BatBook\exceptions\WeakPasswordException;

class User{
    private $id;
    private $email;
    private $password;
    private $nick;

    public function __construct($id, $email, $password, $nick)
    {
        $this->id = $id;
        $this->email = $email;
        $this->setPassword($password);
        $this->nick = $nick;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            throw new WeakPasswordException("Password is too weak.");
        }
        $this->password = $password;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    public function __toString()
    {
        return "User [email=$this->email, nick=$this->nick]";
    }

    public static function save($user) {
        $conexionNew = new Connection();
        $conexion = $conexionNew->getConnection();
        $sql = "INSERT INTO users (email, nick, password) VALUES (:email, :nick, :password)";
        $variables = $conexion->prepare($sql);
        $email = $user->getEmail();
        $nick = $user->getNick();
        $password = $user->getPassword();

        $variables->bindParam(':email', $email);
        $variables->bindParam(':nick', $nick);
        $variables->bindParam(':password', $password);

        $variables->execute();
        return $conexion->lastInsertId();
    }

    public static function getUserNick($nick){
        $conexionNew = new Connection();
        $conexion = $conexionNew->getConnection();

        $sql = "select * from users where nick = ?";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> execute([$nick]);
        return self::getUserForm($sentencia -> fetch());
    }

    public static function getUserEmail($email){
        $conexionNew = new Connection();
        $conexion = $conexionNew->getConnection();

        $sql = "select * from users where email = ?";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> execute([$email]);
        return self::getUserForm($sentencia -> fetch());
    }

    public static function getUserId($id){
        $conexionNew = new Connection();
        $conexion = $conexionNew->getConnection();

        $sql = "select * from users where id = ?";
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> execute([$id]);
        return self::getUserForm($sentencia -> fetch());
    }

    private static function getUserForm($usuario){
        if($usuario){
            return new User($usuario["id"], $usuario["email"], $usuario["password"], $usuario["nick"]);
        } else {
            return null;
        }
    }
}
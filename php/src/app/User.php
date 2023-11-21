<?php
namespace BatBook;
use BatBook\QueryBuilder;
use BatBook\exceptions\WeakPasswordException;
use BatBook\MyLog;
class User{
    public static $nameTable = "users";
    private $id;
    private $email;
    private $password;
    private $nick;
    private $administrador;

    public function __construct($id = '', $email = '', $nick = '', $password = '', $administrador = '')
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->nick = $nick;
        $this->administrador = $administrador;
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

    public function getAdministrador()
    {
        return $this->administrador;
    }

    public function __toString()
    {
        return "User [email=$this->email, nick=$this->nick]";
    }

    public function __toJson()
    {
        return json_encode([
            'id' => $this->id,
            'nick' => $this->nick,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }


    public function getArrayForm(){
        return ["email" => $this->email, "nick" => $this->nick, "password" => $this->password, "administrador" => $this->administrador];
    }

    public static function save($user) {
        return QueryBuilder::insert(User::class, $user->getArrayForm());
    }

    public static function getUserNick($nick){
        $user = QueryBuilder::sql(User::class, ["nick" => $nick]);
        return $user[0] ?? null;
    }

    public static function getUserEmail($email){
        $user = QueryBuilder::sql(User::class, ["email" => $email]);
        return $user[0] ?? null;
    }

    public static function getUserId($id){
        $user = QueryBuilder::sql(User::class, ["id" => $id]);
        return $user[0] ?? null;
    }
}
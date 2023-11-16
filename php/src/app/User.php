<?php
namespace BatBook;
use BatBook\QueryBuilder;
use BatBook\exceptions\WeakPasswordException;

/**
 *
 */
class User{
    /**
     * @var string
     */
    public static $nameTable = "users";
    /**
     * @var mixed|string
     */
    private $id;
    /**
     * @var mixed|string
     */
    private $email;
    /**
     * @var mixed|string
     */
    private $password;
    /**
     * @var mixed|string
     */
    private $nick;

    /**
     * @param $id
     * @param $email
     * @param $nick
     * @param $password
     */
    public function __construct($id = '', $email = '', $nick = '', $password = '')
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->nick = $nick;
    }

    /**
     * @return mixed|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return void
     * @throws WeakPasswordException
     */
    public function setPassword($password)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            throw new WeakPasswordException("Password is too weak.");
        }
        $this->password = $password;
    }

    /**
     * @return mixed|string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param $nick
     * @return void
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return string
     */
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
            'password' => $this->password,
        ]);
    }

    /**
     * @return array
     */
    public function getArrayForm(){
        return ["email" => $this->email, "nick" => $this->nick, "password" => $this->password];
    }

    /**
     * @param $user
     * @return false|string
     */
    public static function save($user) {
        return QueryBuilder::insert(User::class, $user->getArrayForm());
    }

    /**
     * @param $nick
     * @return mixed|null
     */
    public static function getUserNick($nick){
        $user = QueryBuilder::sql(User::class, ["nick" => $nick]);
        return $user[0] ?? null;
    }

    /**
     * @param $email
     * @return mixed|null
     */
    public static function getUserEmail($email){
        $user = QueryBuilder::sql(User::class, ["email" => $email]);
        return $user[0] ?? null;
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function getUserId($id){
        $user = QueryBuilder::sql(User::class, ["id" => $id]);
        return $user[0] ?? null;
    }
}
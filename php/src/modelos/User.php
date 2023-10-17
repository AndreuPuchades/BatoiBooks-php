<?php
class User{
    private $email;
    private $password;
    private $nick;

    public function __construct($email, $password, $nick)
    {
        $this->email = $email;
        $this->setPassword($password);
        $this->nick = $nick;
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
}

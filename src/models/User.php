<?php

class User
{
    private $email;
    private $login;
    private $name;
    private $surname;
    private $password;

    public function __construct($email, $login, $name, $surname, $password)
    {
        $this->email = $email;
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
    }
}
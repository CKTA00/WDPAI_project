<?php

class User
{
    private $email;
    private $login;
    private $name;
    private $surname;
    private $password;
    private $image;

    public function __construct(string $email, string $login, string $name, string $surname, string $password, ?string $image)
    {
        $this->email = $email;
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->image = $image;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }


}
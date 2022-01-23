<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class UserRepository extends Repository
{
    public function getUser(string $loginOrEmail): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :login OR login = :login
        ');
        $stmt->bindParam(":login", $loginOrEmail, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            // TODO throw exception, SecurityController will catch in login
            return null;
        }

        return new User(
            $user['email'],
            $user['login'],
            $user['name'],
            $user['surname'],
            $user['password'],
            $user['profile_image']
        );
    }

    public function addUser(User $user)
    {
        $problems = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
            ');
        $email = $user->getEmail();
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($existingUser) && $existingUser!=false)
        {
            $problems[] = 'This email is already used.';
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE login = :login
            ');
        $login = $user->getLogin();
        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($existingUser) && $existingUser!=false)
        {
            $problems[] = 'This login is already taken.';
        }

        if(strlen($user->getLogin())<3 || $user->getLogin()>254) $problems[] = 'Login needs to have between 3 and 254 characters.';
        if(strlen($user->getName())<1) $problems[] = 'Name is required!';
        if(strlen($user->getSurname())<1) $problems[] = 'Surname is required!';
        if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) $problems[] = 'Typed email is invalid.';

        if(count($problems)>0) return $problems;

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (login,email,password,name,surname) VALUES (?,?,?,?,?)
        ');
        return $stmt->execute([
           $user->getLogin(),
           $user->getEmail(),
           $user->getPassword(),
           $user->getName(),
           $user->getSurname()
        ]);
    }

    public function getUserFromId(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE id = :id
        ');
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            // TODO throw exception, SecurityController will catch in login
            return null;
        }

        return new User(
            $user['email'],
            $user['login'],
            $user['name'],
            $user['surname'],
            $user['password'],
            $user['profile_image']
        );
    }

    public function getUserFromLogin(string $login): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE login = :login
        ');
        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            // TODO throw exception, SecurityController will catch in login
            return null;
        }

        return new User(
            $user['email'],
            $user['login'],
            $user['name'],
            $user['surname'],
            $user['password'],
            $user['profile_image']
        );
    }

    public function getUserSessionPass(string $login): ?string
    {
        $stmt = $this->database->connect()->prepare('
            SELECT session_pass FROM public.users WHERE login = :login
        ');
        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
        $stmt->execute();

        $pass = $stmt->fetch(PDO::FETCH_ASSOC);

        if($pass == false){
            // TODO throw exception, SecurityController will catch in login
            return null;
        }

        return $pass["session_pass"];
    }

    public function setUserSessionPass(string $login, ?string $pass)
    {
        if(isset($pass))
        {
            $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET session_pass = :pass WHERE login = :login
            ');
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);
            $stmt->execute();
        }
        else
        {
            $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET session_pass = NULL WHERE login = :login
            ');
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}
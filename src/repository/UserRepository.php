<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class UserRepository extends Repository
{
    public function getUser(string $login): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :login OR login = :login
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

    public function addUser(User $user)
    {
       $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (login,email,password,name,surname) VALUES (?,?,?,?,?)
        ');
       $success = $stmt->execute([
           $user->getLogin(),
           $user->getEmail(),
           $user->getPassword(),
           $user->getName(),
           $user->getSurname()
       ]);

       if(!$success)
       {
           $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
            ');
           $email = $user->getEmail();
           $stmt->bindParam(":email", $email, PDO::PARAM_STR);
           $stmt->execute();
           $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
           if(isset($existingUser) && $existingUser!=false)
           {
               return 'email';
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
               return 'login';
           }
       }

       return true;
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
}
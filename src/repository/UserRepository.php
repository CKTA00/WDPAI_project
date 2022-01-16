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
}
<?php

require_once "AppController.php";
require_once __DIR__."/../models/User.php";

class SecurityController extends AppController
{
    public function login_user()
    {
        $user = new User('jankowal@mail.com',"admin","Jan","Kowalski","admin");

        if(!$this->isPost())
        {
            return $this->render('login');
        }
        $login = $_POST["login"];
        $password = $_POST["password"];
        if($login !== $user->getEmail() && $login !== $user->getLogin())
        {
            return $this->render("login",["messages"=>["User with this email or login does not exists."]]);
        }
        if($password !== $user->getPassword())
        {
            return $this->render("login",["messages"=>["Wrong password."]]);
        }
        //return $this->render("announcements");
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/announcements");
    }
}
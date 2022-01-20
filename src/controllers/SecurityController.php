<?php

require_once "AppController.php";
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login_user()
    {
        if(!$this->isPost())
        {
            return $this->render('login');
        }
        $login = $_POST["login"];
        $password = sha256($_POST["password"]);

        $user = $this->userRepository->getUser($login);
        if(!$user)
        {
            return $this->render("login",["messages"=>["User does not exist."]]);
        }

        if($login !== $user->getEmail() && $login !== $user->getLogin())
        {
            return $this->render("login",["messages"=>["User with this email or login does not exist."]]);
        }
        if($password !== $user->getPassword())
        {
            return $this->render("login",["messages"=>["Wrong password."]]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/announcements");
    }
}
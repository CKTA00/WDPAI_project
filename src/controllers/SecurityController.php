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

    public function index()
    {
        return $this->login();
    }

    public function login()
    {
        if(!$this->isPost())
        {
            return $this->render('login');
        }
        $login = $_POST["login"];
        $password = hash("sha256", $_POST["password"]);

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

    public function register()
    {
        if(!$this->isPost()) {
            return $this->render('register');
        }
        $login = $_POST["login"];
        $email = $_POST["email"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];
        if($password!==$repeatPassword)
        {
            return $this->render('register',['messages' => ['Your password and repeated password are not the same.']]);
        }
        $password = hash("sha256", $password);
        $user = new User($email,$login,$name,$surname,$password,null);
        $this->userRepository->addUser($user);
        return $this->render('login', ['messages' => ['Success! Log into your new account.']]);
    }
}
<?php

require_once "AppController.php";
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController
{
    private $userRepository;
    const USER_COOKIE = "userLogin";

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

        setcookie(self::USER_COOKIE,$user->getLogin(),time()+3600,"/");

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/announcements");
    }

    public function timeout()
    {
        return $this->render("login",["messages"=>["Session timeout."]]);
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
        $success = $this->userRepository->addUser($user);
        if($success==='login')
        {
            return $this->render('register', ['messages' => ['User with this login already exists.']]);
        }
        else if($success==='email')
        {
            return $this->render('register', ['messages' => ['User with this email already exists.']]);
        }
        return $this->render('login', ['messages' => ['Success! Log into your new account.']]);
    }

    public function logout(){
        setcookie(self::USER_COOKIE,"",time()-100);
        return $this->render('login', ['messages' => ['You successfully log out.']]);
    }
}
<?php

require_once "AppController.php";
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController
{
    private $userRepository;
    const USER_COOKIE = "userLogin";
    const SESSION_PASS_COOKIE = "sessionPass";

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
        if(!$this->authorize()) // assume that user actually wants to continue previous session
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

            $this->beginSession($user);
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/announcements");
    }

    public function timeout()
    {
        return $this->render("login",["messages"=>["Session timeout."]]);
    }

    public function register()
    {
        $this->endSession(); // assume that user wants to log out and register another user
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
        $problems = $this->userRepository->addUser($user);
        if(is_array($problems))
        {
            return $this->render('register', ['messages' => $problems]);
        }
        else if(is_bool($problems) && $problems)
        {
            return $this->render('login', ['messages' => ['Success! Log into your new account.']]);
        }
        else
        {
            return $this->render('register', ['messages' => ["Something went wrong. Contact administrator."]]);
        }
    }

    public function logout(){
        $this->endSession();
        return $this->render('login', ['messages' => ['You successfully log out.']]);
    }

    public function authorize(): bool
    {
        if(isset($_COOKIE[self::USER_COOKIE]) && isset($_COOKIE[self::SESSION_PASS_COOKIE]))
        {
            $sessionPass = $this->userRepository->getUserSessionPass($_COOKIE[self::USER_COOKIE]);
            if($_COOKIE[self::SESSION_PASS_COOKIE] === $sessionPass)
            {
                setcookie(self::USER_COOKIE,$_COOKIE[self::USER_COOKIE],time()+3600,"/");
                setcookie(self::SESSION_PASS_COOKIE,$_COOKIE[self::SESSION_PASS_COOKIE],time()+3600,"/");
                return true;
            }
            else{
                $this->endSession();
                // TODO: Notify FBI about hacker xd
                return false;
            }
        }
        return false;
    }

    private function endSession(){
        if(isset($_COOKIE[self::USER_COOKIE]))
        {
            $this->userRepository->setUserSessionPass($_COOKIE[self::USER_COOKIE],null);
            setcookie(self::USER_COOKIE,"",time()-100);
            setcookie(self::SESSION_PASS_COOKIE,"",time()-100);
        }
    }

    private function beginSession(User $user){
        if(!isset($_COOKIE[self::USER_COOKIE]))
        {
            $sessionPass = sha1($user->getPassword().time());
            $this->userRepository->setUserSessionPass($user->getLogin(),$sessionPass);
            setcookie(self::USER_COOKIE,$user->getLogin(),time()+3600,"/");
            setcookie(self::SESSION_PASS_COOKIE,$sessionPass,time()+3600,"/");
        }
    }

}
<?php

require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AnnouncementController.php';

class Router
{
    public static $routes;
    public static $noLogin;

    public static function get($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function requireNoLogin($url)
    {
        self::$noLogin[] = $url;
    }

    public static function run(?string $url)
    {
        $action = explode("/",$url)[0]; // extraction of key and function name from url
        if(!array_key_exists($action, self::$routes))
        {
            die("404 PAGE NOT FOUND");
        }

        $security=new SecurityController();

        if(in_array($action,self::$noLogin) || $security->authorize()) //do not require authorization or user is authorized
        {
            $controller = self::$routes[$action]; // using $action as a key
            $obj = new $controller; // creating controller object from its name
            $obj->$action(); // using $action as a function name in controller object
        }
        else if(!isset($_COOKIE['userLogin']))
        {
            $security->timeout(); //user session ended
        }
        else
        {
            $security->login(); //unauthorized user
        }
    }
}
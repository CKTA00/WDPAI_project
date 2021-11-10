<?php

require_once 'src/controllers/DashboardController.php';

class Router
{
    public static function run(?string $url){

        $controller = new DashboardController();
        if($url === "login")
        {
            //echo "LOGIN";
            $controller->login();
            // TODO open page
        }
        if($url === "dashboard")
        {
            $controller->dashboard();
            // TODO open page
        }
    }
}
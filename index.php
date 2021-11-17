<?php

require_once "Routing.php";

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

if(empty($path))
{
    $path = 'login'; // rerout here? ...
} 
Router::get('index','DashboardController'); 
Router::get('login','DashboardController');
Router::get('dashboard','DashboardController');
Router::get('users','DashboardController');

Router::run($path); // or rerout in run()?
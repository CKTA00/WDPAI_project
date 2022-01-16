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
Router::get('register','DashboardController');
//announcements edit and full view:
Router::post('new_announcement','AnnouncementController');
Router::get('announcements','AnnouncementController');

Router::post('login_user','SecurityController');
Router::post('register_user','SecurityController');

Router::get('dashboard','DashboardController');
Router::get('chats','DashboardController');
Router::get('options','DashboardController');
Router::get('regain_password','DashboardController');

Router::run($path); // or rerout in run()?
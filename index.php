<?php

require_once "Routing.php";

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

if(empty($path))
{
    $path = 'login';
}
Router::get('index','SecurityController');
Router::requireNoLogin('index');
Router::get('logout','SecurityController');
Router::requireNoLogin('logout');
Router::post('login','SecurityController');
Router::requireNoLogin('login');
Router::post('register','SecurityController');
Router::requireNoLogin('register');

//announcements edit and full view:
Router::post('new_announcement','AnnouncementController');
//Router::post('edit_announcement','AnnouncementController'); TODO
Router::get('get_announcement','AnnouncementController');
Router::get('announcements','AnnouncementController');
Router::get('dashboard','DashboardController');
Router::get('chats','DashboardController');
Router::get('options','DashboardController');
Router::get('regain_password','DashboardController');

Router::run($path);
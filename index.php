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
//This functionality will not be implemented in near future
Router::get('regain_password','SecurityController');
Router::requireNoLogin('regain_password');

//announcements endpoints:
Router::post('new_announcement','AnnouncementController');
Router::post('edit_announcement','AnnouncementController');
Router::post('delete_announcement','AnnouncementController');
Router::get('get_announcement','AnnouncementController');
Router::get('announcements','AnnouncementController');
//dashboard endpoints:
Router::get('dashboard','DashboardController');
Router::get('followed','FollowersController');
Router::get('get_announcement_JSON','DashboardController');
Router::get('follow','FollowersController');
Router::get('unfollow','FollowersController');
//chats endpoints:
//Router::get('chats','DashboardController');
//options endpoints:
Router::get('options','OptionsController');
Router::post('changeProfileImage','OptionsController');
Router::get('deleteProfileImage','OptionsController');

Router::run($path);
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
Router::requireNoLogin('get_announcement');
Router::get('announcements','AnnouncementController');
//dashboard endpoints:
Router::get('dashboard','DashboardController');
Router::get('get_announcement_details','DashboardController');
//followed endpoints:
Router::get('followed','FollowersController');
Router::get('follow','FollowersController');
Router::get('unfollow','FollowersController');
//options endpoints:
Router::get('options','OptionsController');
Router::post('change_profile_image','OptionsController');
Router::post('change_bio','OptionsController');
Router::get('get_bio','OptionsController');
Router::get('delete_profile_image','OptionsController');

Router::run($path);
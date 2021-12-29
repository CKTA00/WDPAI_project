<?php

require_once 'AppController.php'; //raz tylko importuje
require_once __DIR__.'/../models/Notice.php';

class DashboardController extends AppController
{
    public function index(): void
    {
        $this->login();
    }

    public function login(): void
    {
        $this->render('login');
    }

    public function dashboard(): void
    {
        //$data= ["zaginoł kot","korepetycje z matematyki dla dzieci z klas 4-8"];
        $notice = new Notice(
            'Zaginął kot',
            "https://cdn.pixabay.com/photo/2017/11/09/21/41/cat-2934720_1280.jpg",
            "desc",
            "location"
        );

        $notice2 = new Notice('','','','');
        $notice2->setTitle('a')
            ->setImageUrl("https://cdn.pixabay.com/photo/2017/11/09/21/41/cat-2934720_1280.jpg")
            ->setDescription('d2')
            ->setLocation('l2');
        $notice3 = new Notice('','','','');
        $notice3->setTitle('3')
            ->setImageUrl("https://cdn.pixabay.com/photo/2017/11/09/21/41/cat-2934720_1280.jpg")
            ->setDescription('d3')
            ->setLocation('l3');

        $this->render('dashboard', [
            'notices'=>
                [
                    $notice,
                    $notice2,
                    $notice3
                ],
            'title'=>
                [
                    "Tytuł test"
                ],
            'title2'=>

                    "Tytuł test 2"

            ]);
    }

    public function annoucements(): void
    {
        $this->render('annoucements');
    }

    public function chats(): void
    {
        // TODO retrieve users from db
        $this->render('chats',['users'=>[]]);
    }

    public function options(): void
    {
        $this->render('options');
    }

    public function register(): void
    {
        $this->render('register');
    }

    public function regain_password(): void
    {
        $this->render('regain-password');
    }

}
<?php

require_once 'AppController.php'; //raz tylko importuje
require_once __DIR__ . '/../models/Announcement.php';

class DashboardController extends AppController
{
    private AnnouncementRepository $annRep;
    private UserRepository $userRep;

    public function __construct()
    {
        parent::__construct();
        $this->annRep = new AnnouncementRepository();
        $this->userRep = new UserRepository();
    }


    public function dashboard(): void
    {
        //$user = $this->userRep->getUserFromLogin($this->userLogin);
        $anns = $this->annRep->getAnnouncementsByDistance("TODO: location");
        $this->render('dashboard', ["anns"=>$anns]);
    }

    public function chats(): void
    {
        // TODO retrieve users from db
        $this->render('chats',['users'=>[]]);
    }

}
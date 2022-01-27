<?php

require_once 'AppController.php'; //raz tylko importuje
require_once __DIR__ . '/../models/Announcement.php';

class DashboardController extends AppController
{
    private AnnouncementRepository $announcementRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->announcementRepository = new AnnouncementRepository();
        $this->userRepository = new UserRepository();
    }


    public function dashboard(): void
    {
        $anns = $this->announcementRepository->getAnnouncementsByDistance("TODO: location");
        $this->render('dashboard', ["anns"=>$anns]);
    }

    public function get_announcement_JSON(int $annId): void
    {
        header('Content-type: application/json');

        $ann = $this->announcementRepository->getRawAnnouncementDetailsById($annId);
        $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
        $ann += ["follows" => $this->announcementRepository->isUserFollowing($userId,$annId)];
        echo json_encode($ann);
    }


    public function chats(): void
    {
        // TODO retrieve users from db
        $this->render('chats',['users'=>[]]);
    }

}
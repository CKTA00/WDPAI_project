<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Announcement.php';
require_once __DIR__ . '/../repository/AnnouncementRepository.php';
require_once __DIR__ . '/../repository/FollowerRepository.php';


class DashboardController extends AppController
{
    private AnnouncementRepository $announcementRepository;
    private UserRepository $userRepository;
    private FollowerRepository $followerRepository;

    public function __construct()
    {
        parent::__construct(1);
        $this->announcementRepository = new AnnouncementRepository();
        $this->userRepository = new UserRepository();
        $this->followerRepository = new FollowerRepository();
    }


    public function dashboard(): void
    {
        $anns = $this->announcementRepository->getAllAnnouncements();
        $this->render('neighbourhood', ["anns"=>$anns]);
    }

    public function get_announcement_JSON(int $annId): void
    {
        header('Content-type: application/json');

        $ann = $this->announcementRepository->getRawAnnouncementDetailsById($annId);
        $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
        $ann += ["follows" => $this->followerRepository->isUserFollowing($userId,$annId)];
        echo json_encode($ann);
        http_response_code(200);
    }
}
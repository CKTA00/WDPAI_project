<?php

require_once "AppController.php";
require_once __DIR__."/../models/Announcement.php";
require_once __DIR__."/../repository/AnnouncementRepository.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__."/../repository/FollowerRepository.php";

class FollowersController extends AppController
{
    private $announcementRepository;
    private $userRepository;
    private $followerRepository;

    public function __construct()
    {
        parent::__construct(2);
        $this->announcementRepository = new AnnouncementRepository();
        $this->userRepository = new UserRepository();
        $this->followerRepository = new FollowerRepository();
    }

    public function followed()
    {
        $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
        $anns = $this->followerRepository->getFollowsOfUser($userId);
        $this->render('followed', ["anns"=>$anns]);
    }

    public function follow(int $annId)
    {
        $this->changeFollow($annId,true);
    }

    public function unfollow(int $annId)
    {
        $this->changeFollow($annId,false);
    }

    private function changeFollow(int $annId, bool $follow){
        $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
        if($follow)
            $this->followerRepository->addFollower($annId,$userId);
        else
            $this->followerRepository->removeFollower($annId,$userId);
        http_response_code(200);
    }
}
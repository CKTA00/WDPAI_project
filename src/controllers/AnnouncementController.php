<?php

require_once "AppController.php";
require_once __DIR__."/../models/Announcement.php";
require_once __DIR__."/../repository/AnnouncementRepository.php";
require_once __DIR__."/../repository/UserRepository.php";

class AnnouncementController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private array $message = [];
    private $announcementRepository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->announcementRepository = new AnnouncementRepository();
        $this->userRepository = new UserRepository();
    }

    //TODO: manipulate focus id with js script
    public function announcements(int $annId=-1): void
    {
        $userId = 3;//TODO: Fetch user id from session
        $anns = $this->announcementRepository->getAnnouncements($userId);
        if($anns == null)
            $this->message[] = "You have no announcements yet :)";

        if($annId<0)
            $focusIndex = 0;
        else
        {
            $focusIndex=$this->get_focus_index($anns,$annId);
            if($focusIndex==-1)
            {
                $this->message[] = "Your new announcement is still processed. Refresh after few seconds to see it.";
                $focusIndex=0;
            }
        }

        $user = $this->userRepository->getUserFromId($userId);

        $this->render('announcements', [
                'username' => $user->getName().' '.$user->getSurname(),
                'profileImage' => $user->getImage(),
                'messages' => $this->message,
                'anns' => $anns,
                'focusAnnIndex' => $focusIndex
            ]);
    }

    private function get_focus_index($anns,$annId): int
    {
        $arr_size = count($anns);
        for($i = 0; $i<$arr_size;$i++)
        {
            if($anns[$i]->getId()==$annId)
            {
                return $i;
            }
        }
        return -1;
    }

    public function new_announcement(){
        if ($this->isPost() && is_uploaded_file($_FILES["file"]["tmp_name"]) && $this->validate($_FILES["file"]))
        {
            $dbFileName = time().$_FILES["file"]["name"];
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$dbFileName
            );

            //TODO: replace point with location from map
            $anns = new Announcement($_POST['title'], $_POST['description'], $dbFileName, '{"point":[0.0,0.0]}' , $_POST['range']);

            $id = $this->announcementRepository->addAnnouncement($anns);
            return $this->announcements($id);
            //return $this->render('announcements', ['messages' => $this->message, 'anns' => $anns]);
        }
        return $this->render('new_announcement', ['messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file["size"] > self::MAX_FILE_SIZE) {
            $this->message[] = "Image file is too large.";
            return false;
        }

        if (!isset($file["type"]) || !in_array($file["type"], self::SUPPORTED_TYPES)) {
            $this->message[] = 'This file format is not supported.';
            return false;
        }
        return true;
    }
}
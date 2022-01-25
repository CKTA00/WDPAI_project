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
        $anns = $this->announcementRepository->getAnnouncements($this->userLogin);
        if($anns == null)
            $this->message[] = "You have no announcements yet :)";

        if($annId==-1)
        {
            $annId = $anns[0]->getId();
        }

        $user = $this->userRepository->getUserFromLogin($this->userLogin);


        $this->render('announcements', [
                'username' => $user->getName().' '.$user->getSurname(),
                'profileImage' => $user->getImage(),
                'messages' => $this->message,
                'anns' => $anns,
                'focusId' => $annId,
                'focusAnnIndex' => $this->getFocusIndex($anns,$annId)
            ]);
    }

    public function get_announcement(int $annId)
    {

//        if($ann->getOwner()->getLogin() != $this->userLogin)
//        {
//            http_response_code(403);
//        }
        //$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        //if ($contentType === "application/json") {
            //$content = trim(file_get_contents("php://input"));
            //$decoded = json_decode($content, true);

        header('Content-type: application/json');

        $ann = $this->announcementRepository->getRawAnnouncementById($annId);
        echo json_encode($ann);
    }

    public function new_announcement(){
        return $this->edit_announcement();
    }

    public function edit_announcement(){
        if ($this->isPost())
        {
            $id = intval($_POST['id']);

            if(is_uploaded_file($_FILES["file"]["tmp_name"]) && $this->validate($_FILES["file"]))
            {
                $dbFileName = time().$_FILES["file"]["name"];
                move_uploaded_file(
                    $_FILES["file"]["tmp_name"],
                    dirname(__DIR__).self::UPLOAD_DIRECTORY.$dbFileName
                );

                //TODO: replace point with location from map
                $ann = new Announcement($_POST['title'], $_POST['description'], $dbFileName, '{"point":[0.0,0.0]}' , $_POST['range']);
                if($id!=null)
                {
                    $ann->setId($id);
                    $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
                    $this->announcementRepository->editAnnouncement($id,$ann,$userId);
                    return $this->announcements($id);
                }
                else
                {
                    $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
                    $this->announcementRepository->addAnnouncement($ann,$userId);
                    return $this->announcements($id);
                }
            }
            else
            {
                $ann = $this->announcementRepository->getAnnouncementById($id);
                //TODO: check if it's user's announcement
                return $this->render('new_announcement', ['messages' => $this->message, 'ann' => $ann, 'id' => $id]);
            }
        }

        return $this->render('new_announcement', ['messages' => $this->message]);
    }

    public function delete_announcement()
    {
        $id = intval($_POST['id']);
        if ($this->isPost()) {
            $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
            if($this->announcementRepository->deleteAnnouncement($id,$userId)){
                $this->message[] = "Announcement has been deleted.";
            }
            else{
                $this->message[] = "This announcement is already deleted.";
            }

            return $this->announcements();
        }
        $this->message[] = "Failed to delete..";
        return $this->announcements();
    }

    private function getFocusIndex($anns, $annId): int
    {
        $arr_size = count($anns);
        for($i = 0; $i<$arr_size;$i++)
        {
            if($anns[$i]->getId()==$annId)
            {
                return $i;
            }
        }
        return 0;
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
<?php

require_once "AppController.php";
require_once __DIR__."/../models/Announcement.php";
require_once __DIR__."/../repository/AnnouncementRepository.php";
require_once __DIR__."/../repository/UserRepository.php";

class AnnouncementController extends AppController
{
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
        header('Content-type: application/json');
        //TODO: check ownership?
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

            if(is_uploaded_file($_FILES["file"]["tmp_name"]) && $this->validateFile($_FILES["file"]))
            {
                $dbFileName = time().$_FILES["file"]["name"];
                move_uploaded_file(
                    $_FILES["file"]["tmp_name"],
                    dirname(__DIR__).self::UPLOAD_DIRECTORY.$dbFileName
                );

                //TODO: replace point with location from map
                $ann = new Announcement($_POST['title'], $_POST['description'], $dbFileName, $_POST['location'] , $_POST['range']);
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
                    $id = $this->announcementRepository->addAnnouncement($ann,$userId);
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
}
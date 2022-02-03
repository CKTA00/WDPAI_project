<?php

require_once "AppController.php";
require_once __DIR__."/../models/Announcement.php";
require_once __DIR__."/../repository/AnnouncementRepository.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__."/../repository/FollowerRepository.php";

class AnnouncementController extends AppController
{
    private $announcementRepository;
    private $userRepository;
    private $followerRepository;

    public function __construct()
    {
        parent::__construct(3);
        $this->announcementRepository = new AnnouncementRepository();
        $this->userRepository = new UserRepository();
        $this->followerRepository = new FollowerRepository();
    }

    public function announcements(int $annId=-1): void
    {
        $anns = $this->announcementRepository->getAnnouncementsOfUser($this->userLogin);
        if($anns == null)
            $this->message[] = "You have no announcements yet :)";
        else if($annId==-1)
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
        $ann = $this->announcementRepository->getRawAnnouncementById($annId);
        echo json_encode($ann);
    }

    public function new_announcement(){
        if ($this->isPost())
        {
            if(is_uploaded_file($_FILES["file"]["tmp_name"]))
            {
                if(!$this->validateFile($_FILES["file"]))
                {
                    return $this->render('new_announcement', ['messages' => $this->message]);
                }

                $dbFileName = time().$_FILES["file"]["name"];
                move_uploaded_file(
                    $_FILES["file"]["tmp_name"],
                    dirname(__DIR__).self::UPLOAD_DIRECTORY.$dbFileName
                );

                $ann = new Announcement($_POST['title'], $_POST['description'], $dbFileName, $_POST['location'] , $_POST['range']);
                $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
                $id = $this->announcementRepository->addAnnouncement($ann,$userId);
                return $this->announcements($id);
            }
            else
            {
                $this->message[] = 'Image is required.';
                return $this->render('new_announcement', ['messages' => $this->message,'imageRequired'=>true]);
            }
        }

        return $this->render('new_announcement', ['messages' => $this->message,'imageRequired'=>true]);
    }

    public function edit_announcement(){
        if ($this->isPost())
        {
            $id = intval($_POST['id']);
            if(isset($_POST['title']))
            {
                if(is_uploaded_file($_FILES["file"]["tmp_name"]))
                {
                    //user replaced image
                    if(!$this->validateFile($_FILES["file"]))
                    {
                        return $this->render('new_announcement', ['messages' => $this->message]);
                    }

                    $dbFileName = time().$_FILES["file"]["name"];
                    move_uploaded_file(
                        $_FILES["file"]["tmp_name"],
                        dirname(__DIR__).self::UPLOAD_DIRECTORY.$dbFileName
                    );

                    $ann = new Announcement($_POST['title'], $_POST['description'], $dbFileName, $_POST['location'] , $_POST['range']);
                    $ann->setId($id);
                    $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
                    $this->announcementRepository->editAnnouncement($id,$ann,$userId,true);
                    return $this->announcements($id);
                }
                else
                {
                    // user do not replaced image
                    $ann = new Announcement($_POST['title'], $_POST['description'], "_", $_POST['location'] , $_POST['range']);
                    $ann->setId($id);
                    $userId = $this->userRepository->getUserIdFromLogin($this->userLogin);
                    $this->announcementRepository->editAnnouncement($id,$ann,$userId,false);
                    return $this->announcements($id);
                }
            }
            $ann = $this->announcementRepository->getAnnouncementById($id);
            return $this->render('new_announcement', ['messages' => $this->message, 'ann'=>$ann, 'imageRequired'=>false,'id'=>$id]);
        }

        return $this->render('new_announcement', ['messages' => $this->message,'imageRequired'=>true]);
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
        if(is_array($anns))
        {
            $arr_size = count($anns);
            for($i = 0; $i<$arr_size;$i++)
            {
                if($anns[$i]->getId()==$annId)
                {
                    return $i;
                }
            }
        }
        return 0;
    }
}
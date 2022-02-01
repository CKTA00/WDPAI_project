<?php

require_once "AppController.php";
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";

class OptionsController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct(4);
        $this->userRepository = new UserRepository();
    }

    public function options(): void
    {
        $user = $this->userRepository->getUserFromLogin($this->userLogin);
        $this->render('options', [
            'username' => $user->getName().' '.$user->getSurname(),
            'profileImage' => $user->getImage(),
            'messages' => $this->message
        ]);
    }

    public function changeProfileImage(){
        if ($this->isPost() && is_uploaded_file($_FILES["file"]["tmp_name"]) && $this->validateFile($_FILES["file"]))
        {
            $dbFileName = time().$_FILES["file"]["name"];
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$dbFileName
            );
            $this->userRepository->changeUserData($this->userLogin,$dbFileName);
        }

        return $this->options();
    }

    public function deleteProfileImage(){
        $this->userRepository->changeUserData($this->userLogin,null);
        return $this->options();
    }
}
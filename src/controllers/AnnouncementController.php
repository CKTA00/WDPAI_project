<?php

require_once "AppController.php";

class AnnouncementController extends AppController
{
    public function new_announcement(){
        $this->render("new_announcement");
    }
}
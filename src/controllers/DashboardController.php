<?php

require_once 'AppController.php'; //raz tylko importuje

class DashboardController extends AppController
{
    public function login()
    {
        $this->render('login');
    }

    public function dashboard()
    {
        $data= ["zaginoł kot","korepetycje z matematyki dla dzieci z klas 4-8"];
        $this->render('dashboard', ['titles'=>$data]);
    }
   
}
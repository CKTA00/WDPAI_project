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
        $data= ["pizza","burgir"];
        $this->render('dashboard', ['recipes'=>$data]);
    }
   
}
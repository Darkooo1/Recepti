<?php

class AdminZidarController extends AdminController

{
   private $viewDir = 'privatno' . DIRECTORY_SEPARATOR. 'admin' . DIRECTORY_SEPARATOR;

    public function index()

    {
        $this->view->render($this->viewDir . 'index',
    [
        'registrationtable'=>Registration::readRegistration()
    ]);
      
    }

    public function delete()

    {
        Registration::delete();
        header('location: /adminzidar/index');
    }


}
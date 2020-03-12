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

    public function changes()
    {
        
        $registracija = Registration::read($_GET['sifra']);
        if(!$registracija){
            $this->index();
            exit;
    }
    $this->view->render($this->viewDir . 'changes',
    ['registracija'=>$registracija,
        'poruka'=>'Promjenite željene podatke']
);

}

    public function changeregistration()
    {
        Registration::update();
        header('location: /adminzidar/index');
    }
   

}
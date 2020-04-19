<?php

class AdminzidarController extends AdminController

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
        header ('location: /adminzidar/index');
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
        'message'=>'Promjenite željene podatke',
        'sifra'=> $_GET['sifra']
        ]);
    }

    public function changeregistration()
    {
        
        Registration::update();
       header('location: /adminzidar/index');
    }
    
}
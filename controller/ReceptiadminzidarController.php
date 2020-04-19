<?php

class ReceptiadminzidarController extends AdminController

{
   private $viewDir = 'privatno' . DIRECTORY_SEPARATOR. 'receptiadmin' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index',
    [
        'receptitable'=>Recepti::readAll()
    ]);
    }

    public function promjena()
    {
        $recepti = Recepti::read($_GET['sifra']);
        if(!$recepti){
            $this->index();
            exit;
    }
    $this->view->render($this->viewDir . 'promjenarecepta',
    ['recepti'=>$recepti,
        'message'=>'Napravite izmjene na receptu',
        'sifra'=> $_GET['sifra']
        ]);
    }

    public function promjenarecepta()
{
    Recepti::update();
   header('location: /receptiadminzidar/index');
}

    public function delete()
    {
        Recepti::delete();
        header ('location: /receptiadminzidar/index');
        
    }


}
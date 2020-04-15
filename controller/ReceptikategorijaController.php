<?php

class ReceptikategorijaController extends IndexController
{
    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'receptikategorija' .DIRECTORY_SEPARATOR;

    public function index()
    {
        $kategorija=Recepti::receptiizkategorije($_GET['sifra']);
        $this->view->render($this->viewDir . 'index',
    [
        'receptitable'=>$kategorija,
        
    ]);

    
    }


}
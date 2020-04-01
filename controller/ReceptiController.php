<?php

class ReceptiController extends IndexController
{
    private $viewDir='privatno'. DIRECTORY_SEPARATOR. 'recepti'. DIRECTORY_SEPARATOR;

    public function index()
    {
        $podaci=Recepti::read($_GET['sifra']);
        $this->view->render($this->viewDir. 'index',
        ['podaci'=>$podaci]
    
    );
    }








}
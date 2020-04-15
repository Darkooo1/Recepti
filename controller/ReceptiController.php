<?php

class ReceptiController extends IndexController
{
  public function indexRecepti()
    {
       $podaci=Recepti::read($_GET['sifra']);
       $this->view->render('indexrecepti',
        ['podaci'=>$podaci]
    );
    }

    public function pretraga()
    {
        if(!isset($_GET['stranica']) || $_GET['stranica']=='0'){
            $stranica=1;
        }else{
            $stranica=$_GET['stranica'];
        }

        $podaci=Recepti::pretraga($_GET['uvjet'],$stranica);
        if(count($podaci)===0){
            $stranica--;
            $podaci = Recepti::pretraga($_GET['uvjet'],
            $stranica);
        }
        $this->view->render('pocetnastranica',[
            'podaci'=>$podaci,
            'stranica'=>$stranica,
            'uvjet'=>$_GET['uvjet'],
            'stranicenje'=>Recepti::stranicenje($_GET['uvjet'])
           ]);
    }

   public function index()
    {
        
        $this->view->render('pocetnastranica',[
            'podaci'=>Recepti::pretraga('','1'),
            'stranica' => '1',
            'uvjet' => '',
            'stranicenje' => Recepti::stranicenje('')
           ]);  
    }
        








}
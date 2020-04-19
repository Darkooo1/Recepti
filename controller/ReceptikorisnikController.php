<?php

class ReceptikorisnikController extends AuthorizationController
{
    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'receptikorisnik' .DIRECTORY_SEPARATOR;

    public function index()
    {
        
       $receptkorisnik=Recepti::korisnikrecepti($_SESSION['registracija']->sifra);
        $this->view->render($this->viewDir . 'index',
    [
        'receptitable'=>$receptkorisnik
    ]);
    }

    public function unosrecepta()
    {
        if(!isset($_POST['kategorija']) || 
        $_POST['kategorija']=='0'){
            $this->view->render($this->viewDir . 'unosrecepta',[
               
                'alertPoruka'=>'Morate odabrati kategoriju'
            ]);
            return;
            }
        $sifraNovogKreiranogRecepta = Receptikorisnik::create($_POST['kategorija']);
        Receptikorisnik::vezakorisnikrecept($sifraNovogKreiranogRecepta, $_SESSION['registracija']->sifra);
        $this->index();
        
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
        ]
);
    }

    public function promjenarecepta()
    {
    Recepti::update();
   header('location: /receptikorisnik/index');
    }

    public function delete()
    {
        Recepti::delete();
        header('location: /receptikorisnik/index');
    }


}
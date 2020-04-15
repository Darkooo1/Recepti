<?php

class ReceptikorisnikController extends IndexController
{
    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'receptikorisnik' .DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index',
    [
        'receptitable'=>Recepti::readAll()
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
        //print_r($_POST);
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
   /* print_r ($_POST);  */

    Recepti::update();
   header('location: /receptikorisnik/index');
}

    public function delete()
    {
        Recepti::delete();
        header('location: /receptikorisnik/index');
    }


}
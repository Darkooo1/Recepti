<?php

class IndexController extends Controller
{

public function index()
{

    $this->view->render('pocetnastranica',[ 
        'podaci'=>Recepti::pretraga('','1'),
            'stranica' => '1',
            'uvjet' => '',
            'stranicenje' => Recepti::stranicenje('')
    ]);
}

public function login()
{
    $this->view->render('login',
    [
        'message'=> 'Unesite pristupne podatke ili izvršite registraciju',
        'email'=>''
    ]);
} 

public function AuthorizationLogin()
{
    if (!isset($_POST['email']) || !isset($_POST['password']))
    {
        $this->view->render('login',
        [
            'message'=>'Nisu postavljeni pristupni podaci',
            'email'=>''
        ]);
        return;
    }
    if (trim($_POST['email'])==='' || trim($_POST['password'])==='')
    {
        $this->view->render('login',
        [
            'message'=>'Pristupni podaci obavezni',
            'email'=>$_POST['email']
        ]);
        return;
    }
   $vezabaza= Database::getInstanca();
    $izraz=$vezabaza->prepare('select * from registracija where email=:email;');
    $izraz->execute(['email'=>$_POST['email']]);
    $rezultat=$izraz->fetch ();

    if ($rezultat==null)
    {
        $this->view->render('login',
        [
            'message'=>'Ne postojeći korisnik',
            'email'=>$_POST['email']
        ]);
        return;
    }

    if (!password_verify($_POST['password'], $rezultat->password))
    {
        $this->view->render('login',
        [
            'message'=>'Neispravan email ili lozinka',
            'email'=>$_POST['email']
        ]);
        return;
    }
    unset ($rezultat->password);
    $_SESSION['registracija']=$rezultat;
     $npc=new NadzornaplocaController();
     $npc->index();

}
public function logout()
{
    unset ($_SESSION['registracija']);
    session_destroy();
    $this->index();
}

public function era()
{
    $this->view->render('era');
}


}

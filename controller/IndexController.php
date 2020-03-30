<?php

class IndexController extends Controller
{

public function index()
{

    $this->view->render('pocetnastranica',[
        'podaci'=>Recepti::readAll(),
        //'smjerovi' => Smjer::readAll()
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

 

   $vezabaza= database::getInstanca();
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
    $_SESSION ['registracija']=$rezultat;
     $npc=new NadzornaplocaController();
     $npc->index();


    
}
public function logout()
{
    unset ($_SESSION['registracija']);
    session_destroy();
    $this->index();
}


/*
public function refreshtableregistracija()
{
    $vezabaza= database::getInstanca();
    $izraz=$vezabaza->prepare('
    drop table if exists registracija;
    create table registracija(
        sifra       int not null primary key auto_increment,
        username     varchar(50) not null,
        email       varchar(50) not null,
        password     char(60) not null,
        ime         varchar(50) not null,
        prezime     varchar(50) not null, 
        sessionid   varchar(100)
        
        );
        insert into registracija values 
        (null, \'Tomislav\', \'zidarto@hotmail.com\',
        \'$2y$10$1ObtPOr7unAMR6Zpo462Kuea4FkJSy3lLAb1eth86Xa7Kp/gcBhJq\',
        \'Tomislav\', \'Zidar\',null);
        insert into registracija values 
        (null, \'AdminZidar\', \'tozidar@gmail.com\',
        \'$2y$10$b0In9IcFO63vOcA68CAlnemPx8u8lH1z6/1WFcYyFtfLoXiQ2r4DK\',
        \'Admin\', \'Zidar\',null);');
        $izraz->execute();
        
}*/

}

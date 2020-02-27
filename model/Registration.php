<?php

class Registration
{

    public static function readRegistration()
    {
        $vezabaza = database::getInstanca();
        $izraz = $vezabaza->prepare('select * from registracija');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create()
    {
        $vezabaza = database::getInstanca();
        $izraz = $vezabaza->prepare('INSERT INTO registracija(email, password, ime, prezime, username) VALUES (:email, :password, :ime, 
        :prezime, :username)'); 
        unset($_POST['password_confirm']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $izraz->execute($_POST);
       
    }

    public static function delete()
    {
        try{ //na ovakav nacin izvrsavamo radnju u bazi neovisno o nasem programu- 
            //da ne dodje do rusenje cijelog izvodenja programa, uglavnom bi se ttrebalo raditi na ovaka nacin
        $vezabaza = database::getInstanca();
        $izraz = $vezabaza->prepare('delete from registracija where password=:password');
        $izraz->execute($_GET);
    }catch(PDOException $e){  //ukoliko nije uspio izvrsiti try onda funkcijom PDOException ispisujemo do koje je greske doslo u bazi
        echo $e->getMessage(); 
        return false;
    }
    return true;

}

/*
public static function registrationnewemail()
{
    $vezabaza = database::getInstanca();
        $izraz = $vezabaza->prepare('INSERT INTO registracija(email, password, ime, prezime, username,sessionid) 
        VALUES (:email, :password, :ime, :prezime, :username, :sessionid)'); 
        unset($_POST['password_confirm']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $_POST['sessionid'] = session_id();
        $izraz->execute($_POST);
        $headers = "From: Recepti aplikacija <zidarto@hotmail.com>\r\n";
        $headers .= "Reply-To: Recepti APP <zidarto@hotmail.com>\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail($_POST['email'],'Završi registraciju na Recepti aplikacija',
                '<a href="' . PocetnaAPP::konfiguracija('url') . 
                'index/zavrsiregistraciju?id=' . $_POST['sessionid'] . '">Završi</a>', $headers);
}

*/
}
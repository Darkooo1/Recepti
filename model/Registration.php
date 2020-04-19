<?php

class Registration
{
    public static function readRegistration()
    {
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare('select * from registracija where sifra!=2');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare('select sifra, email, ime, prezime, username from registracija
        where sifra=:sifra');
        $izraz->execute(['sifra'=>$sifra]);
        return $izraz->fetch();
    }

    public static function create()
    {
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare('INSERT INTO registracija(email, password, ime, prezime, username) VALUES (:email, :password, :ime, 
        :prezime, :username)'); 
        unset($_POST['password_confirm']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $izraz->execute($_POST);
    }
    
    public static function delete()
    {
        try{ 
        $vezabaza = Database::getInstanca();
       $vezabaza->beginTransaction();
        $izraz = $vezabaza->prepare('select
        registracija from receptiregistracija where registracija=:sifra');
        $izraz->execute($_GET); 
        $sifraregistracija = $izraz->fetchColumn(); 

        $izraz = $vezabaza->prepare('update receptiregistracija 
        set registracija=2
        where registracija=:sifra');
        $izraz->execute([
           'sifra'=>$sifraregistracija
        ]); 
      
       $izraz = $vezabaza->prepare('delete from registracija where sifra=:sifra');
        $izraz->execute($_GET);

        $vezabaza->commit();
       
    }catch(PDOException $e){ 
        echo $e->getMessage(); 
        return false;
    }
    return true;

}

public static function update(){
    try{
    $vezabaza = Database::getInstanca();
    $izraz=$vezabaza->prepare('update registracija 
    set username=:username,email=:email,ime=:ime,prezime=:prezime where sifra=:sifra');
    $izraz->execute($_POST); 
    }
    catch(PDOException $e){  
        echo $e->getMessage(); 
        return false;
    }
    return true;

}

}
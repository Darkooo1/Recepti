<?php

class Receptikorisnik
{
    public static function create($kategorija)
    {
        $vezabaza = Database::getInstanca();
      
        $izraz = $vezabaza->prepare('insert into recepti
        (naziv,kolicina,sastojci,opis,kategorija) values
        (:naziv,:kolicina,:sastojci,:opis,:kategorija)
         ');
        $izraz->execute([
            'naziv' => $_POST['naziv'],
            'kolicina' => $_POST['kolicina'],
            'sastojci' => $_POST['sastojci'],
            'opis' => $_POST['opis'],
           'kategorija' => $kategorija
        ]);
        return $vezabaza->lastInsertId();
    }
    
   public static function vezakorisnikrecept($sifrarecepta,$sifrakorisnik)
   {
    $vezabaza = Database::getInstanca();
    $izraz = $vezabaza->prepare('insert into receptiregistracija
    (recepti,registracija) values
    (:recepti,:registracija)
     ');
    $izraz->execute([
        'recepti' => $sifrarecepta,
        'registracija' => $sifrakorisnik
        
    ]);
   }

}
























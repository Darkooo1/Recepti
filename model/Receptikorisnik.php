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

   public static function vezakorisnikkategorija($sifrakategorija,$sifrakorisnik)
   {
    $vezabaza = Database::getInstanca();
    $izraz = $vezabaza->prepare('select 
    c.sifra, c.naziv, c.kolicina, c.sastojci, c.opis, d.katjela
    from receptiregistracija a inner join registracija b on a.registracija=b.sifra
    left join recepti c on a.recepti=c.sifra
    right join kategorija d on c.kategorija=d.sifra
    where a.registracija=:sifrakorisnik and d.sifra=:sifra
    ');
     $izraz->execute([
        'sifra' => $sifrakategorija,
        
        'sifrakorisnik' => $sifrakorisnik
    ]);
    return $izraz->fetchAll();
   }

}
























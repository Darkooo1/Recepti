<?php

class Recepti{

    public static function readAll()
    {
        $vezabaza = database::getInstanca();
        $izraz = $vezabaza->prepare('
        select 
        a.sifra, a.naziv, a.kolicina, a.sastojci, a.opis, b.katjela 
        from 
        recepti a inner join kategorija b  on a.kategorija=b.sifra
        where a.sifra 
         ');
        $izraz->execute();
        return $izraz->fetchAll();
    }


}
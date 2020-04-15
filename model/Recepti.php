<?php

class Recepti
{

    public static function readAll()
    {
        $vezabaza = Database::getInstanca();
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

    public static function receptiizkategorije($sifrakategorije)
    {
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare(' select 
        a.sifra, a.naziv, a.kolicina, a.sastojci, a.opis, b.katjela
        from recepti a right join kategorija b on a.kategorija=b.sifra
        where b.sifra=:sifra 
         ');
         $izraz->execute(['sifra'=>$sifrakategorije]);
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare('select 
        sifra, naziv, kolicina, sastojci, opis
        from recepti 
        where sifra=:sifra 
         ');
         $izraz->execute(['sifra'=>$sifra]);
        return $izraz->fetch();
    }

    public static function pretraga($uvjet,$stranica)
    {

        $rps=Initialapp::configuration('rezultataPoStranici');

        $od= $stranica*$rps-$rps;
        if ($od<0)
        {
        $od=0;
        }
        $uvjet='%'.$uvjet.'%';
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare(' 
        select 
        a.sifra, a.naziv, a.kolicina, a.sastojci, a.opis, b.katjela 
        from 
        recepti a inner join kategorija b  on a.kategorija=b.sifra
        where 
        concat(a.naziv, \' \',a.sastojci, \' \',b.katjela,\'\')
        like :uvjet 
        group by 
        a.sifra, a.naziv, a.kolicina, a.sastojci, a.opis, b.katjela
        limit :od,8
        
        ');
        $izraz->bindParam('uvjet',$uvjet);
        $izraz->bindValue('od',$od, PDO::PARAM_INT);
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function stranicenje($uvjet)
    {
        $uvjet='%'.$uvjet.'%';
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare(' 
        select 
        count(a.sifra)
        from 
        recepti a inner join kategorija b  on a.kategorija=b.sifra
        where 
        concat(a.naziv, \' \',a.sastojci, \' \',b.katjela,\'\')
        like :uvjet 
        ');
        $izraz->bindParam('uvjet',$uvjet);
        $izraz->execute();
        $ukupnoRezultata=$izraz->fetchColumn();
        return ceil($ukupnoRezultata / Initialapp::configuration('rezultataPoStranici'));
    }

    public static function update(){
        try{
        $vezabaza = Database::getInstanca();   
        $izraz=$vezabaza->prepare('
        UPDATE recepti
        set 
        naziv=:naziv,kolicina=:kolicina,sastojci=:sastojci,opis=:opis 
        where sifra=:sifra');
        $izraz->execute($_POST); 
        }
        catch(PDOException $e){  
            echo $e->getMessage(); 
            return false;
        }
        return true;
    }

    public static function delete()
    {
        try{ 
        $vezabaza = Database::getInstanca();
        $izraz = $vezabaza->prepare('delete from recepti where sifra=:sifra');
        $izraz->execute($_GET);
    }catch(PDOException $e){ 
        echo $e->getMessage(); 
        return false;
    }
    return true;
}




}
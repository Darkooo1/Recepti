<?php

class Kategorija{

    public static function readAll()
    {
        $vezabaza = database::getInstanca();
        $izraz = $vezabaza->prepare('select * from kategorija ');
        $izraz->execute();
        return $izraz->fetchAll();
    }


}
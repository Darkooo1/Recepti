<?php

class database extends PDO
{
    private static $instanca;
    public function __construct($database)
    {
        $dsn = 'mysql:host='. $database['server'] . ';dbname='. $database['baza'].';charset=utf8';
        parent::__construct($dsn,$database['korisnik'],$database['lozinka']);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    public static function getInstanca()
    {
        if (is_null(self::$instanca))
        {
            self::$instanca= new self(PocetnaApp::konfiguracija('database'));
        }
        return self::$instanca;
    }


}
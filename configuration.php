<?php
 if(
    $_SERVER['HTTP_HOST'] === 'localhost' ||
    $_SERVER['HTTP_HOST'] === 'jelasvijetaaplikacija.com' ||
    $_SERVER['SERVER_ADDR']==='127.0.0.1'
    ){
    
return [
    'nazivAPP' => 'RECEPTI',
    'url' => 'http://jelasvijetaaplikacija.com/',
    'dev' => true,
    'rezultataPoStranici' => 8,
    'database'=>[
        'server'=>'localhost',
        'baza'=>'jelasvijeta',
        'korisnik'=>'edunova',
        'lozinka'=>'edunova'
    ]
];
}
else 
{
return [
    'nazivAPP' => 'RECEPTI',
    'url' => 'http://ziki.webaplikacija.com/',
    'rezultataPoStranici' => 8,
    'database'=>[
        'server'=>'localhost',
        'baza'=>BAZANASERVERU,
        'korisnik'=>KORISNIKBAZENASERVERU,
        'lozinka'=>LOZINKASERVERSQL
    ]
];
}

<?php
session_start();
require 'konstante.php';
define("BP",__DIR__ . DIRECTORY_SEPARATOR );

error_reporting(E_ALL);
ini_set("display_errors",1);


$stringputanja = implode(PATH_SEPARATOR,
            [
                BP . "model",
                BP . "controller"
            ]
            );

set_include_path($stringputanja);
spl_autoload_register(function($klasa)
{
    $putanja = explode(PATH_SEPARATOR, get_include_path());
    foreach($putanja as $p){
        
        if(file_exists($p . DIRECTORY_SEPARATOR . $klasa. ".php")){
            include $p . DIRECTORY_SEPARATOR . $klasa. ".php";
            break;
        }
    }
    
});

InitialApp::pocetna();
//pocetna aplikacija recepata


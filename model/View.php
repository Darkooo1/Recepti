<?php

class View
{
    private $layout;

    public function __construct($layout='predlozak')
    {
     $this->layout=$layout;   
    }

    public function render($stranica,$parametri=[])
    {
        
        ob_start();  
        $meniKategorije=Kategorija::readAll();
        extract($parametri);
        include BP . 'view' . DIRECTORY_SEPARATOR . $stranica . '.phtml';
        $sadrzaj = ob_get_clean();  

        include BP . 'view' . DIRECTORY_SEPARATOR . $this->layout . '.phtml';
    }





    
}
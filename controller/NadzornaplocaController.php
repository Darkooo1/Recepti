<?php

class NadzornaplocaController extends AuthorizationController
{
     public function index()
     {
        
         $this->view->render('privatno' . DIRECTORY_SEPARATOR . 'nadzornaPloca');
     }

}
<?php

class NadzornaplocaController extends AuthorizationController
{
     public function index()
     {
         $this->view->render('privately' . DIRECTORY_SEPARATOR . 'nadzornaPloca');
     }

}
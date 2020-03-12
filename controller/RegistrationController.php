<?php

class RegistrationController extends Controller

{
    private $viewDir = 'privately' . DIRECTORY_SEPARATOR . 'registration' . DIRECTORY_SEPARATOR;

    public function index()

    {
        $this->view->render($this->viewDir . 'newRegistration', 
        [
            'message'=>'Potrebno je popuniti sve podatke'
        ]);
      
    }

    /*
    public function new()
    {
        $this->view->render($this->viewDir . 'newRegistration', 
        [
            'message'=>'Potrebno je popuniti sve podatke'
        ]);
    }
*/
    public function createnewuser()
    {
        Registration::create();
        
        $this->view->render($this->viewDir. 'index',
        [
             'user'=>$_POST['username']
        ]);
    }
    


}
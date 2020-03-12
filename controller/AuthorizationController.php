<?php

class AuthorizationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset ($_SESSION['registracija']))
        {
            $this->view->render ('login',
            [
                'message'=>'Potrebna je prijava!',
                'email'=>''
            ]);
            exit;
        }
    }
}
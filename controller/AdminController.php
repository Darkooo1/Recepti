<?php

class AdminController extends AuthorizationController
{
    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['registracija']->username!=='AdminZidar')
        {
            $ic=new IndexController();
            $ic->logout();
            exit;
        }
    }
}

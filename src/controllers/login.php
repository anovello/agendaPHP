<?php

include_once('api/controllerBase.php');

class Login extends Base
{

    public function index()
    {
        if ($this->islogged()->status)
        {
            header('Location: '.BASE_URL.'home');
            return;
        }
        require(BASE_URI.'src/view/login.php');
    }
}
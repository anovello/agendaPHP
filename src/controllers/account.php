<?php

include_once('api/controllerBase.php');

class Account extends Base
{

    public function index()
    {
        if (!$this->islogged()->status)
        {
            header('Location: '.BASE_URL);
            return;
        }

        require(BASE_URI.'src/view/account.php');
    }
}
<?php

session_start();

class Base
{  

    function islogged()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->name !== '')
        {
            return (Object) ['status' => true];
        } else {
            return (Object) ['status' => false];
        }
    }
}
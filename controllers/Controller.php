<?php

namespace Controllers;

class Controller
{
    protected function checkLogin()
    {
        if( !isset($_SESSION['user'])) {
            header('Location: http://homestead.app' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}
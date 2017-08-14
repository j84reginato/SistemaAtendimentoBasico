<?php

namespace helpers;

class Security
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            header('location:' . APP_ROOT . 'admin/session');
            exit();
        }
    }
}

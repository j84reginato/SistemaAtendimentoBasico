<?php

namespace controllers\admin;

use controllers\Controller;
use helpers\Security;

final class HomeController extends Controller
{
    public function index()
    {
        new Security();
        $this->view();
    }
}

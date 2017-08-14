<?php

namespace App\Controller\Site;

use controllers\Controller;

final class HomeController extends Controller
{
    /**
     * index
     *
     */
    public function index()
    {
        $this->title = 'Home-Page KdDoctor';
        $this->data = array(
            'user_type' => 'patient',
            'med_spcts' => array(),
            'lab_exams' => array(),
            'img_exams' => array(),
            'cities' => array()
        );
        $this->view();
    }
}

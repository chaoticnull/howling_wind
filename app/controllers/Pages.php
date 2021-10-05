<?php

namespace HowlingWind\Controllers;

use HowlingWind\Libraries\Controller;

class Pages extends Controller
{
    public function __construct()
    {
        //echo 'pages constructed' . PHP_EOL;
    }

    public function index(array $params)
    {
        $this->view('pages/Index', ['title' => 'Welcome']);
    }

    public function about(array $params)
    {
        $this->view('pages/About', ['title' => 'About Us']);
    }
}

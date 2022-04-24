<?php

namespace App\Controllers;

class AboutController extends Controller
{
    /**
     * Show the home page
     */
    public function index()
    {
        $this->view->render('about', [], 'About');
    }
}

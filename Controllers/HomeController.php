<?php

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Show the home page
     */
    public function index()
    {
        $this->view->render('stick-it', [], 'Stick It');
    }
}

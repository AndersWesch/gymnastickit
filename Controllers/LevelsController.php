<?php

namespace App\Controllers;

class LevelsController extends Controller
{
    /**
     * Show the home page
     */
    public function index()
    {
        $this->view->render('levels', [], 'Gymnastick It', false);
    }
}

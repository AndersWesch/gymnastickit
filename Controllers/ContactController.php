<?php

namespace App\Controllers;

class ContactController extends Controller
{
    /**
     * Show the home page
     */
    public function index()
    {
        $this->view->render('contact', [], 'Gymnastick It');
    }
}

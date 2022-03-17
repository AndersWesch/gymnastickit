<?php

namespace App\Controllers;

use App\System\View;

class Controller
{
    /**
     *  Constructor
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Redirect to a specific page
     */
    public function redirectTo($page)
    {
        $address = $_SERVER['HTTP_ORIGIN'];

        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            $address = 'http://localhost:8000';
        }

        header('Location: ' . $address . '/' . $page);
        die();
    }
}

<?php
namespace App\Controllers;

class ErrorsController extends Controller
{
    /**
     * Show Error 404 Page Not Found
     */
    public function error404()
    {
        $url = $_SERVER["REQUEST_URI"];

        // If from Facebook redirect to home
        if (strpos($url, '?fbclid=') !== false) {
            $urlPieces = explode('?', $url);
            $originalUrl = substr($urlPieces[0], 1); // trim first char (/)

            $this->redirectTo($originalUrl);
        }

        // If from Facebook add
        if (strpos($url, '?fbadd') !== false) {
            $urlPieces = explode('?', $url);
            $originalUrl = substr($urlPieces[0], 1); // trim first char (/)

            $this->redirectTo($originalUrl);
        }

        echo "Error 404 Page Not Found";
    }
}

<?php

namespace App\System;

class Bootstrap
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $errorPage = false;

        $path = trim($_SERVER['REQUEST_URI'], '/');

        // Router
        if ($path !== '') {
            $tokens = explode('/', $path);

            // Dispatcher
            $controllerName = ucfirst(array_shift($tokens)) . 'Controller';

            if (file_exists('../Controllers/' . $controllerName . '.php')) {
                $controllerName = 'App\Controllers\\' . $controllerName;
                $controller = new $controllerName();

                // Actions (methods)
                if (!empty($tokens)) {
                    $actionName = array_shift($tokens);

                    if (method_exists($controller, $actionName)) {
                        // Passing parameters
                        $controller->{$actionName}(@$tokens);
                    } else {
                        $errorPage = true;
                    }

                } else {
                    // Default action
                    $controller->index();
                }

            } else {
                // No controller found
                $errorPage = true;
            }

        } else {
            // No controller entered
            $controllerName = 'App\Controllers\HomeController';
            $controller = new $controllerName();
            $controller->index();
        }

        // Error 404 Page Not Found
        if ($errorPage) {
            $controllerName = 'App\Controllers\ErrorsController';
            $controller = new $controllerName();
            $controller->error404();
        }
    }
}

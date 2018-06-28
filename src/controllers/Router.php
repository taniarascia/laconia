<?php

/**
 * Router Class
 * 
 * This code was originally created for The PHP Practitioner course on Laracasts.
 * I have modified it for my purposes, adding Session, List, and User classes into the 
 * controller, as well as routing usernames and dynamic URLs such as edit/:list_id.
 * 
 * @link https://github.com/laracasts/The-PHP-Practitioner-Full-Source-Code/blob/master/core/Router.php
 */

use Laconia\Session;
use Laconia\ListClass;
use Laconia\User;
use Laconia\Comment;

class Router
{
    /**
     * All registered routes.
     */

    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user's routes file.
     */

    public static function load($file)
    {
        $router = new static;

        require $file;
        return $router;
    }

    /**
     * Register a GET route.
     */

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route.
     */

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Load the requested URI's associated controller method.
     */

    public function direct($uri, $requestType)
    {
        $userControl = new User;
        $username = $userControl->getUserByUsername($uri);

        // If uri contains edit, go to edit controller
        if (($pos = strpos($uri, '/')) !== false) { 
            if (strpos($uri, 'edit') !== false) {
                $param = substr($uri, $pos+1); 
                $uri = 'edit';
            } 
        }
        // Gather all users from the database and compare against uri 
        elseif ($username) {
            $uri = 'user';
        } 

        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        } 
        throw new Exception('No route defined for this URI.');
    }

    /**
     * Load and call the relevant controller action.
     */
    
    protected function callAction($controller, $action)
    {
        $session = new Session;
        $userControl = new User;
        $list = new ListClass;
        $comment = new Comment;

        $controller = new $controller($session, $userControl, $list, $comment);

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action();
    }
}
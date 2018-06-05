<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    // Home page
    case '/':
        require '../views/home.php';
        break;
    // About page
    case '/login':
        require '../views/login.php';
        break;
    // Everything else
    default:
        //header('HTTP/1.0 404 Not Found');
        require '../views/404.php';
        break;
}
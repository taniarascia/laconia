<?php

$request = $_SERVER['REDIRECT_URL'];

switch ($request) {
    case '/' :
        require __DIR__ . '/public/index.php';
        break;
    case '' :
        require __DIR__ . '/public/index.php';
        break;
    case '/home':
        require __DIR__ . '/public/home.php';
        break;
    case '/login':
        require __DIR__ . '/public/login.php';
        break;
    case '/logout':
        require __DIR__ . '/public/logout.php';
        break;
    case '/register':
        require __DIR__ . '/public/register.php';
        break;
    case '/forgot-password':
        require __DIR__ . '/public/forgot-password.php';
        break;
    case '/reset-password':
        require __DIR__ . '/public/create-password.php';
        break;
    default: 
        require __DIR__ . '/public/404.php';
        break;
}
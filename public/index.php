<?php

session_start();
require __DIR__ . '../vendor/autoload.php';

switch ($_SERVER['REDIRECT_URL']) {
    case '/' :
        require __DIR__ . '../src/Controllers/index.php';
        break;
    case '' :
        require __DIR__ . '../src/Controllers/index.php';
        break;
    case '/home':
        require __DIR__ . '../src/Controllers/home.php';
        break;
    case '/login':
        require __DIR__ . '../src/Controllers/login.php';
        break;
    case '/logout':
        require __DIR__ . '../src/Controllers/logout.php';
        break;
    case '/register':
        require __DIR__ . '../src/Controllers/register.php';
        break;
    case '/forgot-password':
        require __DIR__ . '../src/Controllers/forgot-password.php';
        break;
    case '/reset-password':
        require __DIR__ . '../src/Controllers/reset-password.php';
        break;
    case '/forgot-password-process':
        require __DIR__ . '../src/Controllers/forgot-password-process.php';
        break;
    default: 
        require __DIR__ . '../src/Views/404.php';
        break;
}
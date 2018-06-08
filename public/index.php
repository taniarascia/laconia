<?php

// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

session_start();

// Router
switch ($_SERVER['REDIRECT_URL']) {
    case '/' :
        require $root . '/src/controller/index.php';
        break;
    case '' :
        require $root . '/src/controller/index.php';
        break;
    case '/home':
        require $root . '/src/controller/home.php';
        break;
    case '/login':
        require $root . '/src/controller/login.php';
        break;
    case '/logout':
        require $root . '/src/controller/logout.php';
        break;
    case '/register':
        require $root . '/src/controller/register.php';
        break;
    case '/forgot-password':
        require $root . '/src/controller/forgot-password.php';
        break;
    case '/reset-password':
        require $root . '/src/controller/reset-password.php';
        break;
    case '/forgot-password-process':
        require $root . '/src/controller/forgot-password-process.php';
        break;
    default: 
        require $root . '/src/404.php';
        break;
}
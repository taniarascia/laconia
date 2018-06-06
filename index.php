<?php

require __DIR__ . '/config/credentials.php';
require __DIR__ . '/vendor/autoload.php';

switch ($_SERVER['REDIRECT_URL']) {
    case '/' :
        require __DIR__ . '/public/controller/index.php';
        break;
    case '' :
        require __DIR__ . '/public/controller/index.php';
        break;
    case '/home':
        require __DIR__ . '/public/controller/home.php';
        break;
    case '/login':
        require __DIR__ . '/public/controller/login.php';
        break;
    case '/logout':
        require __DIR__ . '/public/controller/logout.php';
        break;
    case '/register':
        require __DIR__ . '/public/controller/register.php';
        break;
    case '/forgot-password':
        require __DIR__ . '/public/controller/forgot-password.php';
        break;
    case '/reset-password':
        require __DIR__ . '/public/controller/reset-password.php';
        break;
    case '/forgot-password-process':
        require __DIR__ . '/public/controller/forgot-password-process.php';
        break;
    default: 
        require __DIR__ . '/public/404.php';
        break;
}
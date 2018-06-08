<?php

use Laconia\Database;

// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

// Begin user session
session_start();

// Routing
$redirect = $_SERVER['REDIRECT_URL'];
$controllerName = ltrim($redirect, '/');
$controllerPath = $root . "/src/controller/$controllerName.php";

if ($controllerName === '') {
    require $root . '/src/controller/index.php';
} elseif (file_exists($controllerPath)) {
    require $root . "/src/controller/$controllerName.php";
} else {
    require $root . '/src/controller/404.php';
}
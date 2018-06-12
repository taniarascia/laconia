<?php

// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

// Begin user session
session_start();

// Routing
$redirect = $_SERVER['REDIRECT_URL'];
$controllerName = getControllerName($redirect);
$controllerPath = $root . "/src/controllers/$controllerName.php";

if ($controllerName === '') {
    $controller = new Index();
} elseif (file_exists($controllerPath)) {
    $controller = new $controllerName();
} else {
    $controller = new ExceptionNotFound();
}

$controller->show();
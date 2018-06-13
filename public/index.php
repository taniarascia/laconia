<?php

session_start();

// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

// Routing
$redirect = $_SERVER['REDIRECT_URL'];
$method = $_SERVER['REQUEST_METHOD'];

$controllerName = getControllerName($redirect);
$controllerPath = $root . "/src/controllers/$controllerName.php";

if ($controllerName === '') {
    $controller = new Index();
} elseif (file_exists($controllerPath)) {
    $controller = new $controllerName();
} else {
    $controller = new ExceptionNotFound();
}

if ($method === 'POST') {
    $controller->post();
} else {
    $controller->get();
}
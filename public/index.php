<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/credentials.php';

$url = $_SERVER['REDIRECT_URL'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

$controller = ucfirst(ltrim($url, '/')) . 'Controller';

if ($url === '' || $url === '/') {
	(new HomeController())->get();
} else if (file_exists('../src/Controllers/' . $controller . '.php')) {
	$controller = new $controller();
	$method === 'POST' ? $controller->post() : $controller->get();
} else {
	(new ExceptionController())->notFound();
}

<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$url = $_SERVER['REDIRECT_URL'] ?? NULL;

if (!$url || $url === '/' || $url === '' || $url === '/home') {
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		(new ExceptionController())->homeView();
	}
} else if ($url === '/register') {
	if ($_SERVER['method'] === 'GET') {
		(new RegisterController())->view();
	} else {
		(new RegisterController())->register();
	}
}

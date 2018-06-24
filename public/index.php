<?php

/*!
 * Laconia 
 * 
 * An MVC application written in plain PHP without libraries or frameworks.
 * 
 * PHP Version 7.2
 * 
 * @version 1.0
 * @author  Tania Rascia
 * @license https://github.com/taniarascia/laconia/blob/master/LICENSE MIT License
 * @link    https://github.com/taniarascia/laconia
 * @issues  https://github.com/taniarascia/laconia/issues
 * @since   March 14, 2018 
 * 
 * Laconia is a personal project to learn the fundamentals of programming and 
 * modern webapp development from scratch. The main goals of my project are to learn 
 * MVC (Model View Controller) architecture, the OOP (Object-Oriented Programming) 
 * paradigm, routing, modern development practices, and how to tie it all together
 * to make a functional webapp. 
 * 
 * Laconia runs on PHP 7.2 and MySQL. It uses composer to autoload classes and 
 * configuration and utility files, as well as future tests through PHPUnit.
 * Node is used to compile Sass to CSS via npm scripts.
 * 
 * Please feel free to fork, use, comment, critique, suggest, improve or help in any way.
 */

use Laconia\Session;
use Laconia\User;

// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

// Initialize session and user models
$session = new Session();
$userControl = new User();

// Routing
$redirect = $_SERVER['REDIRECT_URL'];
$method = $_SERVER['REQUEST_METHOD'];

// Get the path after the hostname
$path = ltrim($redirect, '/');

// Check if path matches a user
$username = $userControl->getUserByUsername(ltrim($path));

// Get controller name by converting URL of dashes
// (such as forgot-password) to uppercase class names
// (such as ForgotPassword) and assign to the proper
// controller based on URL.
$controllerName = getControllerName($redirect);
$controllerPath = $root . "/src/controllers/{$controllerName}.php";

// Load index page first
if ($controllerName === '') {
    $controller = new Index($session, $userControl);
}
// If the controller exists, route to the proper controlller 
elseif (file_exists($controllerPath)) { // to do: add approved filenames
    $controller = new $controllerName($session, $userControl);
}
// If path matches user in the database, route to the public
// user profile.
elseif ($username) {
    $controller = new UserProfile($session, $userControl);
} 
// If all else fails, 404.
else {
    $controller = new ExceptionNotFound($session, $userControl);
}

// Detect if method is GET or POST and route accordingly.
if ($method === 'POST') {
    $controller->post();
} else {
    $controller->get();
}
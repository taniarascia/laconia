<?php

use Laconia\Session;
use Laconia\User;

// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

// Start session
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


// Testing, will remove later
// ========================================================

echo "<br><br>Sessions: ";
print_r($_SESSION);

$loggedIn = $session->isUserLoggedIn() ? 'Yes' : 'No';
$userId = $session->getSessionValue('user_id');

$userControl = new User();
$whoIsLoggedIn = $userControl->getUser($userId);

echo "<br>";
echo "Logged in: {$loggedIn} - {$whoIsLoggedIn['username']}";

/**
 * TODO:
 * 
 * X Clean up password validation code
 * X Allow user to create a list with list items - laconia.test/create-list
 * - Edit-list pages that are actually editable
 * X Create public facing user profile - laconia.test/$username - will require Apache redirects? or PHP redirects?
 * - Add JavaScript to XHR validation and POSTing
 * - Settings page
 * - Top navigation bar when logged in
 * - CSS styles
 * 
 * SOURCES:
 * 
 * - Password reset: http://thisinterestsme.com/php-reset-password-form/
 * - Login: http://thisinterestsme.com/php-user-registration-form/
 * - PDO class: https://www.culttt.com/2012/10/01/roll-your-own-pdo-php-class/
 * - Password validation: https://stackoverflow.com/questions/22544250/php-password-validation/22544286
 * - Editing: https://ilovephp.jondh.me.uk/en/tutorial/make-your-own-blog
 */
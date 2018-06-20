<?php
// Get the directory above public
$root = __DIR__ . '/..';

// Autoload config and classes
require $root . '/vendor/autoload.php';

// Start session
$session = new Session($_SESSION);

// Routing
$redirect = $_SERVER['REDIRECT_URL'];
$method = $_SERVER['REQUEST_METHOD'];

$controllerName = getControllerName($redirect);
$controllerPath = $root . "/src/controllers/{$controllerName}.php";

if ($controllerName === '') {
    $controller = new Index($session);
} elseif (file_exists($controllerPath)) {
    $controller = new $controllerName($session);
} else {
    $controller = new ExceptionNotFound($session);
}

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

$user = new User();
$whoIsLoggedIn = $user->getUser($userId);

echo "<br>";
echo "Logged in: {$loggedIn} {$whoIsLoggedIn['username']}";

/**
 * TODO:
 * 
 * - Clean up password validation code
 * X Allow user to create a list with list items - laconia.test/create-list
 * - Create public facing user profile - laconia.test/$username - will require Apache redirects? or PHP redirects?
 * - Add JavaScript to XHR validation and POSTing
 */
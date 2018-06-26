<?php

class Router
{
  private static $instance;

  private function __construct($redirectURL, $method)
  {
  }

  public static function getInstance()
  {
    if ( is_null( self::$instance ) )
    {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function someMethod1()
  {
    // whatever
  }

  public function someMethod2()
  {
    // whatever
  }
}

// // Routing
// $redirect = $_SERVER['REDIRECT_URL'];
// $method = $_SERVER['REQUEST_METHOD'];
// $path = ltrim($redirect, '/');

// // Check if path matches a user
// $username = $userControl->getUserByUsername($path);

// // Get controller name by converting URL of dashes
// // (such as forgot-password) to uppercase class names
// // (such as ForgotPassword) and assign to the proper
// // controller based on URL.
// $controllerName = getControllerName($redirect);
// $controllerPath = $root . "/src/controllers/{$controllerName}.php";

// // Load index page first
// if ($controllerName === '') {
//     $controller = new Index($session, $userControl);
// }
// // If the controller exists, route to the proper controlller 
// elseif (file_exists($controllerPath)) { // to do: add approved filenames
//     $controller = new $controllerName($session, $userControl);
// }
// // If path matches user in the database, route to the public
// // user profile.
// elseif ($username) {
//     $controller = new UserProfile($session, $userControl);
// } 
// // If all else fails, 404.
// else {
//     $controller = new ExceptionNotFound($session, $userControl);
// }

// // Detect if method is GET or POST and route accordingly.
// if ($method === 'POST') {
//     $controller->post();
// } else {
//     $controller->get();
// }
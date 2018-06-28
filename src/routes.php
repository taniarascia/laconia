<?php

$router->get('', 'IndexController@get');
$router->post('', 'IndexController@post');

$router->get('login', 'LoginController@get');
$router->post('login', 'LoginController@post');

$router->get('forgot-password', 'ForgotPasswordController@get');
$router->post('forgot-password', 'ForgotPasswordController@post');

$router->get('reset-password', 'ResetPasswordController@get');
$router->post('reset-password', 'ResetPasswordController@post');

$router->get('create-password', 'CreatePasswordController@get');
$router->post('create-password', 'CreatePasswordController@post');

$router->get('register', 'RegisterController@get');
$router->post('register', 'RegisterController@post');

$router->get('home', 'HomeController@get');
$router->post('home', 'HomeController@post');

$router->get('logout', 'LogoutController@get');

$router->get('settings', 'SettingsController@get');
$router->post('settings', 'SettingsController@post');

$router->get('create', 'CreateController@get');
$router->post('create', 'CreateController@post');

$router->get('edit', 'EditController@get');
$router->post('edit', 'EditController@post');

$router->get('view-users', 'ViewUsersController@get');

$router->get('user', 'UserProfileController@get');
$router->post('user', 'UserProfile@post');

$router->get('404', 'ExceptionNotFoundController@get');
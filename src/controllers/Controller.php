<?php

abstract class Controller
{
    protected $page_title;
    protected $title;
    protected $message;

    // Show the view
    protected function view($view) {
        $view = strtolower($view);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/../src/views/' . $view . '.view.php';
    }

    // Set new header location
    protected function redirect($view) {
        $view = strtolower($view);

        header('Location: /' . $view );
        exit;
    }

    // Is user logged in
    protected function authenticate() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
            //User not logged in. Redirect them back to the login.php page.
            header('Location: /login');
            exit;
        }
    }
}
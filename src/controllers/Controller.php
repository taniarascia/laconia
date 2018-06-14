<?php

abstract class Controller
{ 
    protected $page_title;
    protected $message;

    protected function view($view) {
        $view = strtolower($view);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/../src/views/' . $view . '.view.php';
    }

    protected function redirect($view) {
        $view = strtolower($view);

        header('Location: /' . $view );
        exit;
    }

    protected function authenticate() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
            //User not logged in. Redirect them back to the login.php page.
            header('Location: /login');
            exit;
        }
    }

    protected function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['time_logged_in'] = time();
    }

    protected function logout() {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_id']);

        session_destroy();
    }

    protected function encryptPassword($password) {
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        return $password;
    }

    protected function verifyPassword($submittedPassword, $password) {
        $validPassword = password_verify($submittedPassword, $password);
        
        return $validPassword;
    }
}
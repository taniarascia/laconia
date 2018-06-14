<?php

class Session
{   
    private $isLoggedIn;

    public function __construct() {
        session_start();
    }

    public function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['time_logged_in'] = time();

        $this->isLoggedIn = true;
    }

    public function logout() {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['time_logged_in']);

        session_destroy();

        $this->isLoggedIn = false;
    }

    public function authenticate() {
        if ($this->isLoggedIn === false) {
            // User not logged in. 
            header('Location: /login');
            exit;
        }
    }

    public function isUserLoggedIn() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
            $this->isLoggedIn = false;

            return $this->isLoggedIn;
        } else {
            $this->isLoggedIn = true;
            
            return $this->isLoggedIn;
        }
    }

    public function setPasswordRequestId($userId) {
        $_SESSION['user_id_reset_pass'] = $userId;
    }

    public function setSessionValue($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function deleteSessionValue($key) {
        unset($_SESSION[$key]);
    }

    public function getSessionValue($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
}
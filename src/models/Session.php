<?php

class Session
{   
    public function __construct() {
       if (!isset($_SESSION)) {
            session_start();
       }
    }

    public function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['time_logged_in'] = time();
    }

    public function logout() {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['time_logged_in']);

        session_destroy();
    }

    public function authenticate() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
            header('Location: /login');
        }
    }

    public function isUserLoggedIn() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
            return false;
        } else {
            return true;
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
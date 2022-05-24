<?php

namespace Laconia;

/** 
 * Session Class
 * 
 * Determine and modify the state of user authentication.
 * 
 * While the User class is used to access and modify permanent user
 * data in the `users` table, the Session class is used to check the 
 * state of a user's authentication. Laconia uses the PHP session 
 * superglobal to determine if a user is logged in or not.
 */
class Session
{

    /**
     * Initialize the session with class instantiation.
     * 
     */
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION['csrf'])) {
            if (function_exists('random_bytes')) {
                $_SESSION['csrf'] = bin2hex(random_bytes(32));
            } else {
                $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
            }
        }
    }

    /**
     * Set the user ID session, a boolean and the time the session
     * was authenticated.
     * 
     */
    public function login($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['time_logged_in'] = time();
    }

    /**
     * Unset all session variables and destroy the session.
     */
    public function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['time_logged_in']);

        session_destroy();
    }

    /**
     * Determine if user is logged in, and redirect to the login screen
     * if not.
     */
    public function authenticate($userId)
    {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in']) || $userId !== $_SESSION['user_id']) {
            header('Location: /login');
        }
    }

    /**
     * Return true if user is logged in.
     */
    public function isUserLoggedIn()
    {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Validate CSRF 
     */
    public function validateCSRF($csrf)
    {
        if (!hash_equals($_SESSION['csrf'], $csrf)) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Set session to test if user resetting password is the same
     * one who initiated the request.
     */
    public function setPasswordRequestId($userId)
    {
        $_SESSION['user_id_reset_pass'] = $userId;
    }

    /**
     * Set a session value.
     */
    public function setSessionValue($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Unset a session value.
     */
    public function deleteSessionValue($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Obtain a session value by key.
     * Return value or null.
     */
    public function getSessionValue($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
}

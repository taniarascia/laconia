<?php

/**
 * Controller Class
 * 
 * Connects the database and session models to the front-end views
 * 
 * The Controller class directs traffic to the proper view, and
 * contains common functions used throughout the routes. It is
 * initialized with the Session and User database models, giving 
 * each extended controller the ability to access those databases.
 */

namespace Laconia;

abstract class Controller
{ 
    protected $page_title;
    protected $message;
    protected $session;
    protected $userControl;

    /**
     * Initialize controller with Session and User classes.
     */

    public function __construct($session, $userControl) 
    {
        $this->session = $session;
        $this->userControl = $userControl;
    }

    /**
     * Shortcut to retrieve JavaScript file from the /js/ directory.
     * Returns a URL.
     */

    protected function getScript($filename) 
    {
        $file = strtolower($filename);

        return 'http://' . $_SERVER['HTTP_HOST'] . '/js/' . $file . '.js';
    }

    /**
     * Shortcut to retrieve stylesheet file from the /css/ directory.
     * Returns a URL.
     */

    protected function getStylesheet($filename) 
    {
        $file = strtolower($filename);

        return 'http://' . $_SERVER['HTTP_HOST'] . '/css/' . $file . '.css';
    }

    /**
     * Retireve a view URL by filename.
     * Requires a file.
     */

    protected function view($view) 
    {
        $view = strtolower($view);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/../src/views/' . $view . '.view.php';
    }

    /**
     * Check if the current page is the Index.
     * Returns a Boolean.
     */

    protected function isIndex() 
    {
        $redirect = ltrim($_SERVER['REDIRECT_URL'], '/');
        
        return $redirect === '';
    }

    /**
     * Check if the current page is specified page.
     * Returns a Boolean.
     */

    protected function isPage($view) 
    {
        $view = strtolower($view);

        $redirect = ltrim($_SERVER['REDIRECT_URL'], '/');
        
        return $redirect === $view;
    } 

    /**
     * Redirects to the specified page.
     */

    protected function redirect($view) 
    {
        $view = strtolower($view);

        header('Location: /' . $view );
        exit;
    }

    /**
     * Securely hash a password.
     * Returns hashed password.
     */

    protected function encryptPassword($password) 
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        return $passwordHash;
    }

    /**
     * Vertify a submitted password against existing password.
     * Return a Boolean.
     */   

    protected function verifyPassword($submittedPassword, $password) 
    {
        $validPassword = password_verify($submittedPassword, $password);
        
        return $validPassword;
    }

    /**
     * Check if a username is in the list of disallowed usernames.
     * Return a Boolean.
     */

    protected function isApprovedUsername($username) 
    {
        $approved = in_array($username, DISALLOWED_USERNAMES) ? false : true;

        return $approved;
    }

    /**
     * Check if username is empty, and make sure it only contains
     * alphanumeric characters, numbers, dashes, and underscores.
     * Return an error or null.
     */

    protected function validateUsername($username) 
    {
        if (!empty($username)) {
            if (strlen($username) < '3') {
                $this->errors[] = USERNAME_TOO_SHORT;
            }
            if (strlen($username) > '50') {
                $this->errors[] = USERNAME_TOO_LONG;
            }
            // Match a-z, A-Z, 1-9, -, _.
            if (!preg_match("/^[a-zA-Z\d-_]+$/i", $username)) {
                $this->errors[] = USERNAME_CONTAINS_DISALLOWED;
            }
        } else {
            $this->errors[] = USERNAME_MISSING;
        }
    }

    /**
     * Check if password is empty, and make sure it conforms
     * to password security standards.
     * Return an error or null.
     */

    protected function validatePassword($password) 
    {
        if (!empty($password)) {
            if (strlen($password) < '8') {
                $this->errors[] = PASSWORD_TOO_SHORT;
            }
            if (!preg_match("#[0-9]+#", $password)) {
                $this->errors[] = PASSWORD_NEEDS_NUMBER;
            }
            if (!preg_match("#[A-Z]+#", $password)) {
                $this->errors[] = PASSWORD_NEEDS_UPPERCASE;
            }
            if (!preg_match("#[a-z]+#", $password)) {
                $this->errors[] = PASSWORD_NEEDS_LOWERCASE;
            }
        } else {
            $this->errors[] = PASSWORD_MISSING;
        }
    }

    /**
     * Check if email is empty, and test it against PHP built in
     * email validation.
     * Return an error or null.
     */

    protected function validateEmail($email) 
    {
        if (!empty($email)) {
            // Remove all illegal characters from email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            // Validate e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = EMAIL_NOT_VALID;
            }
        } else {
            $this->errors[] = EMAIL_MISSING;
        }
    }

    /**
     * Get list of errors from validation.
     * Return a string.
     */

    protected function getErrors($errors) 
    {
        foreach ($errors as $error) {
            $this->errorList .= $error . '<br>';
        }
        return $this->errorList;
    }
}
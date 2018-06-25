<?php

namespace Laconia;

abstract class Controller
{ 
    protected $page_title;
    protected $message;
    protected $session;

    public function __construct($session, $userControl) {
        $this->session = $session;
        $this->userControl = $userControl;
    }

    public function getScript($filename) {
        $file = strtolower($filename);

        return 'http://' . $_SERVER['HTTP_HOST'] . '/js/' . $file . '.js';
    }

    public function getStylesheet($filename) {
        $file = strtolower($filename);

        return 'http://' . $_SERVER['HTTP_HOST'] . '/css/' . $file . '.css';
    }

    protected function view($view) {
        $view = strtolower($view);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/../src/views/' . $view . '.view.php';
    }

    protected function redirect($view) {
        $view = strtolower($view);

        header('Location: /' . $view );
        exit;
    }

    protected function encryptPassword($password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        return $passwordHash;
    }

    protected function verifyPassword($submittedPassword, $password) {
        $validPassword = password_verify($submittedPassword, $password);
        
        return $validPassword;
    }

    protected function isApprovedUsername($username) {
        if (in_array($username, DISALLOWED_USERNAMES)) {
            return false;
        } else {
            return true;
        }
    }

    protected function validateUsername($username) {
        if (!empty($username)) {
            if (strlen($username) < '4') {
                $this->errors[] = USERNAME_TOO_SHORT;
            }
            // Match a-z, A-Z, 1-9, -, _. ^[\w-]+$
            if (!preg_match("/^[a-z0-9 .\-]+$/i", $username)) {
                $this->errors[] = USERNAME_CONTAINS_DISALLOWED;
            }
        } else {
            $this->errors[] = USERNAME_MISSING;
        }
    }

    protected function validatePassword($password) {
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

    protected function validateEmail($email) {
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

    protected function getErrors($errors) {
        foreach ($errors as $error) {
            $this->errorList .= $error . '<br>';
        }
        return $this->errorList;
    }
}
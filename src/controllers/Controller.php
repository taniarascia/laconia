<?php

namespace Laconia;

abstract class Controller
{ 
    protected $page_title;
    protected $message;

    public function __construct($session, $userControl) {
        $this->session = $session;
        $this->userControl = $userControl;
    }

    public function getScript($filename) {
        $file = strtolower($filename);

        return 'http://' . $_SERVER['HTTP_HOST'] . '/js/' . $file . '.js';
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
                $this->usernameErrors[] = USERNAME_TOO_SHORT;
            }
            if (!preg_match("([A-Za-z0-9\-\_]+)\b", $username)) {
                $this->usernameErrors[] = USERNAME_CONTAINS_DISALLOWED;
            }
        } else {
            $this->usernameErrors[] = USERNAME_MISSING;
        }
    }

    protected function validatePassword($password) {
        if (!empty($password)) {
            if (strlen($password) < '8') {
                $this->passwordErrors[] = PASSWORD_TOO_SHORT;
            }
            if (!preg_match("#[0-9]+#", $password)) {
                $this->passwordErrors[] = PASSWORD_NEEDS_NUMBER;
            }
            if (!preg_match("#[A-Z]+#", $password)) {
                $this->passwordErrors[] = PASSWORD_NEEDS_UPPERCASE;
            }
            if (!preg_match("#[a-z]+#", $password)) {
                $this->passwordErrors[] = PASSWORD_NEEDS_LOWERCASE;
            }
        } else {
            $this->passwordErrors[] = PASSWORD_MISSING;
        }
    }

    protected function getUsernameErrors($errors) {
        foreach ($this->usernameErrors as $error) {
            $this->errorList .= $error . '<br>';
        }
        return $this->errorList;
    }

    protected function getPasswordErrors($errors) {
        foreach ($this->passwordErrors as $error) {
            $this->errorList .= $error . '<br>';
        }
        return $this->errorList;
    }
}
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

    protected function validatePassword($password) {
        if (!empty($password)) {
            if (strlen($password) < '8') {
                $this->passwordErrors[] = 'Password must contain at least 8 characters.';
            }
            if (!preg_match("#[0-9]+#", $password)) {
                $this->passwordErrors[] = 'Password must contain at least 1 number.';
            }
            if (!preg_match("#[A-Z]+#", $password)) {
                $this->passwordErrors[] = 'Password must contain at least 1 uppercase letter.';
            }
            if (!preg_match("#[a-z]+#", $password)) {
                $this->passwordErrors[] = 'Password must contain one lowercase letter.';
            }
        } else {
            $this->passwordErrors[] = "You must include a password.";
        }
    }

    protected function getPasswordErrors($errors) {
        foreach ($this->passwordErrors as $error) {
            $this->errorList .= $error . ' ';
        }
        return $this->errorList;
    }
}
<?php

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
}
<?php

use Laconia\User;

class Register extends Controller
{
    public $page_title = 'Register';
    public $message;
    public $loggedIn;
    public $errorList = '';
    public $passwordErrors = [];

    public function validatePassword($password) {
        if (!empty($password)) {
            switch ($password) {
                case (strlen($password) < '8') :
                    $this->passwordErrors[] = 'Password must contain at least 8 characters.';
                case (!preg_match("#[0-9]+#", $password)) :
                    $this->passwordErrors[] = 'Password must contain at least 1 number.';
                case (!preg_match("#[A-Z]+#", $password)) :
                    $this->passwordErrors[] = 'Password must contain at least 1 uppercase letter.';
                case (!preg_match("#[a-z]+#", $password)) :
                    $this->passwordErrors[] = 'Password must contain one lowercase letter.';
            }
        } else {
            $this->passwordErrors[] = "You must include a password.";
        }
    }

    public function getPasswordErrors($errors) {
        foreach ($this->passwordErrors as $error) {
            $this->errorList .= $error . ' ';
        }
        return $this->errorList;
    }

    public function post() {
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];
        
        $this->validatePassword($password);
        $usernameSearchResults = $this->userControl->isUsernameAvailable($username);
        $emailSearchResults = $this->userControl->isEmailAvailable($email);

        // Username already exists error
        if ($usernameSearchResults > 0) {
            $this->message = 'That username already exists!';
        } elseif ($emailSearchResults > 0) {
            $this->message = 'That email already exists!';
        } elseif (!empty($this->passwordErrors)) {
            $this->errorList = $this->getPasswordErrors($this->passwordErrors);
            $this->message = $this->errorList;
        } else {
            // Make sure user is logged out
            $this->session->logout();

            // Hash the password
            $passwordHash = $this->encryptPassword($password);
            $result = $this->userControl->registerNewUser($username, $passwordHash, $email, 'user');
            
            // User registration successful
            if ($result) {
                $userInfo = $this->userControl->getUserByUsername($username);
                $this->session->login($userInfo);

                $this->redirect('home');
            }
        }

        $this->view('register');
    }

    public function get() {
        $isLoggedIn = $this->session->isUserLoggedIn();

        if ($isLoggedIn) {
            $this->redirect('home');
        }
        
        $this->view('register');
    }
}
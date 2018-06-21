<?php

use Laconia\Controller;

class Register extends Controller
{
    public $page_title = 'Register';
    public $message;
    public $errorList = '';
    public $passwordErrors = [];

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
        } 
        // Email already exists
        elseif ($emailSearchResults > 0) {
            $this->message = 'That email already exists!';
        } 
        // Password failed validation
        elseif (!empty($this->passwordErrors)) {
            $this->errorList = $this->getPasswordErrors($this->passwordErrors);
            $this->message = $this->errorList;
        } else {
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
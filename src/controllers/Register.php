<?php

use Laconia\Controller;

class Register extends Controller
{
    public $page_title = 'Register';
    public $message;
    public $errorList = '';
    public $passwordErrors = [];
    public $usernameErrors = [];

    public function post() {
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];
        
        $this->validatePassword($password);
        $this->validateUsername($username);

        $usernameSearchResults = $this->userControl->isUsernameAvailable($username);
        $emailSearchResults = $this->userControl->isEmailAvailable($email);
        $isApprovedUsername = $this->isApprovedUsername($username);

        // Empty email field
        if (empty($post['email'])) {
            $this->message = EMAIL_MISSING;
        }
        // Username already exists in the database
        elseif ($usernameSearchResults > 0) {
            $this->message = USERNAME_EXISTS;
        }
        // Username does matches with a disallowed username
        elseif (!$isApprovedUsername) {
            $this->message = USERNAME_NOT_APPROVED;
        } 
        // Email already exists in the database
        elseif ($emailSearchResults > 0) {
            $this->message = EMAIL_EXISTS;
        } 
        // Password failed validation
        elseif (!empty($this->passwordErrors)) {
            $this->errorList = $this->getPasswordErrors($this->passwordErrors);
            $this->message = $this->errorList;
        } 
        // Username failed validation
        elseif (!empty($this->usernameErrors)) {
            $this->errorList = $this->getUsernameErrors($this->usernameErrors);
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
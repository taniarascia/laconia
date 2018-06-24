<?php

use Laconia\Controller;

class Register extends Controller
{
    public $page_title = 'Register';
    public $message;
    public $errorList = '';
    public $errors = [];

    public function validateNewUser($username, $password, $email) {
        // Make sure password passes proper testing, username does not
        // contain special characters, and email is valid.
        $this->validatePassword($password);
        $this->validateUsername($username);
        $this->validateEmail($email);

        $usernameSearchResults = $this->userControl->isUsernameAvailable($username);
        $emailSearchResults = $this->userControl->isEmailAvailable($email);
        $isApprovedUsername = $this->isApprovedUsername($username);

        // Username already exists in the database
        if ($usernameSearchResults > 0) {
            $this->message = USERNAME_EXISTS;
        }
        // Email already exists in the database
        elseif ($emailSearchResults > 0) {
            $this->message = EMAIL_EXISTS;
        } 
        // Username does matches with a disallowed username
        elseif (!$isApprovedUsername) {
            $this->message = USERNAME_NOT_APPROVED;
        } 
    }

    public function post() {
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];

        $this->validateNewUser($username, $password, $email);

        if (!empty($this->errors)) {
            $this->errorList = $this->getErrors($this->errors);
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
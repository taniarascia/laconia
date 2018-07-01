<?php

use Laconia\Controller;

class RegisterController extends Controller
{
    public $pageTitle = 'Register';
    public $message;
    public $user;
    public $errorList = '';
    public $errors = [];

    /**
     * Make sure password passes proper testing, username does not
     * contain special characters, and email is valid.
     */

    public function validateNewUser($username, $password, $email) 
    {
        $this->validatePassword($password);
        $this->validateUsername($username);
        $this->validateEmail($email);

        $usernameSearchResults = $this->userControl->isUsernameAvailable($username);
        $emailSearchResults = $this->userControl->isEmailAvailable($email);
        $isApprovedUsername = $this->isApprovedUsername($username);

        // Username already exists in the database
        if ($usernameSearchResults > 0) {
            $this->errors[] = USERNAME_EXISTS;
        }
        // Email already exists in the database
        elseif ($emailSearchResults > 0) {
            $this->errors[] = EMAIL_EXISTS;
        } 
        // Username does matches with a disallowed username
        elseif (!$isApprovedUsername) {
            $this->errors[] = USERNAME_NOT_APPROVED;
        } 
    }

    public function post() 
    {
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];

        // Validate username, password, and email
        $this->validateNewUser($username, $password, $email);

        // Show errors if any tests failed
        if (!empty($this->errors)) {
            $this->errorList = $this->getErrors($this->errors);
            $this->message = $this->errorList;
            
            echo $this->message;
            exit;
        } else {
            // Hash the password
            $passwordHash = $this->encryptPassword($password);
            $result = $this->userControl->registerNewUser($username, $passwordHash, $email, 'user');
            
            // User registration successful
            if ($result) {
                $this->user = $this->userControl->getUserByUsername($username);
                $this->session->login($this->user);
                $this->message = 'Proceed';

                echo $this->message;
                exit;
            }
        }

        $this->view('register');
    }

    public function get() 
    {
        $isLoggedIn = $this->session->isUserLoggedIn();

        if ($isLoggedIn) {
            $this->redirect('home');
        }
        
        $this->view('register');
    }
}
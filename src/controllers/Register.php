<?php

class Register extends Controller
{
    public $page_title = 'Register';
    public $message;
    public $loggedIn;

    public function validatePassword() {
        
    }

    public function post() {
        $user = new User();
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];

        // Password check:
        $passwordApproved = true;

        if (!empty($password)) {
            if (strlen($password) < '8') {
                $passwordError = 'Must contain at least 8 characters.';
                $passwordApproved = false;
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $passwordError = 'Must contain at least 1 number.';
                $passwordApproved = false;
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $passwordError = 'Must contain at least 1  uppercase letter.';
                $passwordApproved = false;
            }
            elseif (!preg_match("#[a-z]+#", $password)) {
                $passwordError = 'Must contain one lowercase letter.';
                $passwordApproved = false;
            }
        } else {
            $passwordError = "You must include a password.";
            $passwordApproved = false;
        }
        
        $usernameSearchResults = $user->isUsernameAvailable($username);
        $emailSearchResults = $user->isEmailAvailable($email);

        // Username already exists error
        if ($usernameSearchResults > 0) {
            $this->message = 'That username already exists! Try again.';
        } elseif ($emailSearchResults > 0) {
            $this->message = 'That email already exists! Try again.';
        } elseif (!$passwordApproved) {
            $this->message = $passwordError;
        } else {
            // Make sure user is logged out
            $this->session->logout();

            // Hash the password
            $passwordHash = $this->encryptPassword($password);
            $result = $user->registerNewUser($username, $passwordHash, $email, 'user');
            
            // User registration successful
            if ($result) {
                $userInfo = $user->getUserByUsername($username);
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
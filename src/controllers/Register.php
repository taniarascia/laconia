<?php

class Register extends Controller
{
    public $page_title = 'Register';
    public $message;

    public function get() {
        if (isset($_POST['register'])) {
            $user = new User();
            
            // Get form values
            $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
            $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
            $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

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
                // Hash the password
                $password = $this->encryptPassword($password);
                $result = $user->registerNewUser($username, $password, $email);
                
                // User registration successful
                if ($result) {
                    $this->message = 'Thank you for registering with our website. <a href="/login">Login</a>';
                }
            }
        }
        $this->view('register');
    }
}
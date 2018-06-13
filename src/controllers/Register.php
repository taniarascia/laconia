<?php

class Register extends Controller
{
    public $page_title = 'Register';
    public $title = SITE_NAME;
    public $message;

    public function show() {
        if (isset($_POST['register'])) {
            $user = new User();
            
            // Get form values
            $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
            $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
            $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
            
            // TO ADD: Error checking (username characters, password length, etc).
            $usernameSearchResults = $user->isUsernameAvailable($username);

            // Username already exists error
            if ($usernameSearchResults > 0) {
                $this->message = 'That username already exists! Try again.';
            } else {
            
                // Hash the password
                $password = $user->encryptPassword($password);
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
<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
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
                    $this->passwordErrors[] = 'Password must contain at least 1  uppercase letter.';
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
        $user = new User();
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];
        
        $this->validatePassword($password);
        $usernameSearchResults = $user->isUsernameAvailable($username);
        $emailSearchResults = $user->isEmailAvailable($email);

        // Username already exists error
        if ($usernameSearchResults > 0) {
            $this->message = 'That username already exists! Try again.';
        } elseif ($emailSearchResults > 0) {
            $this->message = 'That email already exists! Try again.';
        } elseif (!empty($this->passwordErrors)) {
            $this->errorList = $this->getPasswordErrors($this->passwordErrors);
            $this->message = $this->errorList;
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
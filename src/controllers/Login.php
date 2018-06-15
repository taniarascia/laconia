<?php

class Login extends Controller
{
    public $page_title = 'Login';
    public $message;

    public function post() {
        $user = new User();
        
        // Get form values
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        
        // Retrieve the user account information for the given username.
        $userInfo = $user->getUserByUsername($username);
        
        // Could not find a user with that username
        if (!$userInfo) {
            $this->message = 'Incorrect username / password combination!';
        } else {
            // User account found.
            $validPassword = $this->verifyPassword($password, $userInfo['password']);
            
            if ($validPassword) {
                // User login
                $this->session->login($userInfo);
                $this->redirect('home');
            } else {
                $this->message = 'Incorrect username / password combination!';
            }
        }

        $this->view('login');
    }

    public function get() {
        $isLoggedIn = $this->session->isUserLoggedIn();

        if ($isLoggedIn) {
            $this->redirect('home');
        }

        $this->view('login');
    }
}
<?php

use Laconia\Controller;

class Login extends Controller
{
    public $page_title = 'Login';
    public $user;
    public $message;

    public function post() 
    {
        $post = filter_post();

        $username = $post['username'];
        $password = $post['password'];
        $email = $post['email'];
        
        // Retrieve the user account information for the given username
        $this->user = $this->userControl->getUserByUsername($username);
        
        // Could not find a user with that username
        if (!$this->user) {
            $this->message = LOGIN_FAIL;
            echo $this->message;
        } else {
            // User account found
            $correctPassword = $this->verifyPassword($password, $this->user['password']);
            
            if ($correctPassword) {
                // User login
                $this->session->login($this->user);
                //$this->redirect('home');
            } else {
                $this->message = LOGIN_FAIL;
                echo $this->message;
            }
        }

        //$this->view('login');
    }

    public function get() 
    {
        $isLoggedIn = $this->session->isUserLoggedIn();

        if ($isLoggedIn) {
            $this->redirect('home');
        }

        $this->view('login');
    }
}
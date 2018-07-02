<?php

use Laconia\Controller;

class LoginController extends Controller
{
    public $pageTitle = 'Login';
    public $user;
    public $message;
    public $csrf;

    public function post() 
    {
        $post = filter_post();
        //$this->session->validateCSRF($post['csrf']);

        $username = $post['username'];
        $password = $post['password'];
        
        
        // Retrieve the user account information for the given username
        $this->user = $this->userControl->getUserByUsername($username);
        
        // Could not find a user with that username
        if (!$this->user) {
            $this->message = USERNAME_NOT_EXISTS;

            echo $this->message;
            exit;
        } else {
            // User account found
            $correctPassword = $this->verifyPassword($password, $this->user['password']);
            
            if ($correctPassword) {
                //User login
                $this->session->login($this->user);
                $this->message = 'Proceed';

                echo $this->message;
                exit;
            } else {
                $this->message = LOGIN_FAIL;
                echo $this->message;
                exit;
            }
        }
    }

    public function get() 
    {
        $isLoggedIn = $this->session->isUserLoggedIn();
        $this->csrf = $this->session->getSessionValue('csrf');

        if ($isLoggedIn) {
            $this->redirect('home');
        }

        $this->view('login');
    }
}
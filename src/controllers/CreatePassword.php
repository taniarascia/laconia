<?php

use Laconia\Controller;

class CreatePassword extends Controller
{
    public $page_title = 'Create New Password';
    public $message;
    public $errorList = '';
    public $errors = [];
    public $success = false;

    public function post() 
    {
        $post = filter_post();

        // Get user id from protected session
        $userId = $this->session->getSessionValue('user_id_reset_pass');
        
        // If user is not logged in, redirect to forgot password page
        if (!$userId) {
            $this->redirect('forgot-password');
        }

        // Get password from form
        $password = $post['password'];

        // Reset errors
        $this->errors = array();

        // Make sure password passes validation
        $this->validatePassword($password);
    
        // Display errors if password validation failed
        if (!empty($this->errors)) {
            $this->errorList = $this->getErrors($this->errors);
            $this->message = $this->errorList;

            echo $this->message;
            exit;
        } 
        // Create new password 
        else {
            $passwordHash = $this->encryptPassword($password);
            $result = $this->userControl->resetUserPassword($passwordHash, $userId);
            
            if ($result) {
                // Success
                $this->success = true;
                $this->message = PASSWORD_UPDATED;

                echo $this->message;

                // Make sure they can't keep resetting it
                $this->session->deleteSessionValue('user_id_reset_pass');
                exit;
            }
        }
    }
    
    public function get() 
    {
        // Get user id from protected session
        $userId = $this->session->getSessionValue('user_id_reset_pass');
        
        // If user is not logged in, redirect to forgot password page
        if (!$userId) {
            $this->redirect('forgot-password');
        }

        $this->view('create-password');
    }
}
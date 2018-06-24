<?php

use Laconia\Controller;

class CreatePassword extends Controller
{
    public $page_title = 'Create New Password';
    public $message;
    public $errorList = '';
    public $errors = [];
    public $success = false;

    public function post() {
        $userId = $this->session->getSessionValue('user_id_reset_pass');
        $post = filter_post();

        if (!$userId) {
            $this->redirect('forgot-password');
        }

        $password = $post['password'];

        $this->errors = array();
        $this->validatePassword($password);
    
        if (!empty($this->errors)) {
            $this->errorList = $this->getErrors($this->errors);
            $this->message = $this->errorList;
        } else {
            $passwordHash = $this->encryptPassword($password);
            $result = $this->userControl->resetUserPassword($passwordHash, $userId);
            
            if ($result) {
                // Success
                $this->success = true;
                $this->message = 'Your password has been updated.';
                $this->session->deleteSessionValue('user_id_reset_pass');
            }
        }

        $this->view('create-password');
    }
    
    public function get() {
        $userId = $this->session->getSessionValue('user_id_reset_pass');

        if (!$userId) {
            $this->redirect('forgot-password');
        }

        $this->view('create-password');
    }
}
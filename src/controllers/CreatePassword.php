<?php

class CreatePassword extends Controller
{
    public $page_title = 'Create New Password';
    public $message;

    public function post() {
        $user = new User();
        $userId = $_SESSION['user_id_reset_pass'];
            
        if (!$userId) {
            $this->redirect('reset-password');
        }

        // Get form value
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
        // Hash the new password
        $passwordHash = $this->encryptPassword($password);
        $result = $user->resetUserPassword($passwordHash, $userId);
        
        if ($result) {
            // Success
            $this->message = 'Your password has been updated. <a href="/login">Login</a>';
            unset($userId);
        }

        $this->view('create-password');
    }
    
    public function get() {
        $user = new User();
        $userId = $_SESSION['user_id_reset_pass'];
            
        if (!$userId) {
            $this->redirect('reset-password');
        }

        $this->view('create-password');
    }
}
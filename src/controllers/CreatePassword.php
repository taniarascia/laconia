<?php

class CreatePassword extends Controller
{
    public $page_title = 'Create New Password';
    public $title = SITE_NAME;
    public $message;

    public function show() {
        
        $resetPass = $_SESSION['user_id_reset_pass'];
            
        if (!$resetPass) {
            header('Location: /login');
        }

        if (isset($_POST['create'])) {
            $database = new Database();
            $resetPass = $_SESSION['user_id_reset_pass'];
            
            $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
        
            // Hash the new password
            $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));
            
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $database->query($sql);
            $database->bind(':password', $passwordHash);
            $database->bind(':id', $resetPass);
        
            $result = $database->execute();
            
            if ($result) {
                // Success
                $this->message = 'Your password has been updated. <a href="/login">Login</a>';
            }
        }
        $this->view('create-password');
    }
}
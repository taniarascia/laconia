<?php

class ForgotPassword extends Controller
{
    public $page_title = 'Forgot Password';
    public $message;

    public function get() {
        if (isset($_POST['reset'])) {
            $db = new Database();
            $user = new User();

            // Get form values
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $userInfo = $user->getUserByEmail($email);

            // Email doesn't exist
            if (empty($userInfo)) {
                $this->message = 'That email address was not found in our system!';
            } else {
                // Create a secure token for this forgot password request.
                $token = openssl_random_pseudo_bytes(16);
                $token = bin2hex($token);
                
                $request = $user->createPasswordRequest($userInfo['id'], $token);
                
                // Get the ID of the row 
                $passwordRequestId = $db->lastInsertId();

                // Verify forgot password script
                $verifyScript = 'http://' . $_SERVER['HTTP_HOST'] . '/forgot-password-process';
                $linkToSend = $verifyScript . '?uid=' . $userInfo['id'] . '&id=' . $passwordRequestId . '&t=' . $token;
                
                // This would email in a production site
                $this->message = "<a href='$linkToSend'>Click here to reset</a>";
            }
        }
        $this->view('forgot-password');
    }
}
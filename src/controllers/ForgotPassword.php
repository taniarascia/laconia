<?php

use Laconia\Controller;

class ForgotPassword extends Controller
{
    public $page_title = 'Forgot Password';
    public $message;

    public function post() {
        $db = new Database();
        $post = filter_post();

        $userInfo = $this->userControl->getUserByEmail($post['email']);

        // Email doesn't exist
        if (empty($userInfo)) {
            $this->message = 'That email address was not found in our system!';
        } else {
            // Create a secure token for this forgot password request.
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);
            
            $request = $this->userControl->createPasswordRequest($userInfo['id'], $token);
            
            // Get the ID of the row 
            $passwordRequestId = $db->lastInsertId();

            // Verify forgot password script
            $verifyScript = 'http://' . $_SERVER['HTTP_HOST'] . '/forgot-password-process';
            $linkToSend = $verifyScript . '?uid=' . $userInfo['id'] . '&id=' . $passwordRequestId . '&t=' . $token;
            
            // This would email in a production site
            $this->message = "<a href='{$linkToSend}'>Click here to reset</a>";
        }

        $this->view('forgot-password');
    }

    public function get() {
        $this->view('forgot-password');
    }
}
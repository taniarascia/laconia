<?php

use Laconia\Controller;
use Laconia\Database;

class ForgotPassword extends Controller
{
    public $page_title = 'Forgot Password';
    public $message;
    public $user;
    public $success = false;

    public function post() 
    {
        $post = filter_post();
        $email = $post['email'];
        $db = new Database();

        $this->user = $this->userControl->getUserByEmail($email);

        // Email doesn't exist
        if (empty($this->user)) {
            $this->message = EMAIL_NOT_EXISTS;

            echo $this->message;
            exit;
        } 
        // Email exists, proceed
        else {
            $this->success = true;
            // Create a secure token for this forgot password request.
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);
            
            $request = $this->userControl->createPasswordRequest($this->user['id'], $token);
            
            // Get the ID of the row 
            $passwordRequestId = $db->lastInsertId();

            // Verify forgot password script
            $verifyScript = 'http://' . $_SERVER['HTTP_HOST'] . '/forgot-password-process';
            $linkToSend = $verifyScript . '?uid=' . $this->user['id'] . '&id=' . $passwordRequestId . '&t=' . $token;
            
            // This would email in a production site
            $this->message = $linkToSend;

            echo $this->message;
            exit;
        }
    }

    public function get() 
    {
        $isLoggedIn = $this->session->isUserLoggedIn();

        if ($isLoggedIn) {
            $this->redirect('home');
        }

        $this->view('forgot-password');
    }
}
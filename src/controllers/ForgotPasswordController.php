<?php

use Laconia\Controller;
use Laconia\Database;

class ForgotPasswordController extends Controller
{
    public $page_title = 'Forgot Password';
    public $message;
    public $user;
    public $success = false;

    public function post() 
    {
        $post = filter_post();
        $email = FILTER_VALIDATE_EMAIL($post['email']);
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
            $passwordRequestId = $db->lastInsertId();

            // Create URL for password script
            $url = "http://{$_SERVER['HTTP_HOST']}/reset-password";
            $passwordResetLink = "{$url}?uid={$this->user['id']}&id={$passwordRequestId}&t={$token}";

            @mail(
                $email, 
                'Password Reset', 
                "Here is your password reset link: {$passwordResetLink}", 
                'From: no-reply@taniarascia.com' . "\r\n" .
                'Reply-To: no-reply@taniarascia.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion(),
                null);
            
            // This would email in a production site
            $this->message = PASSWORD_EMAIL_SENT;

            echo $this->message;
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
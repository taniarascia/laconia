<?php

class ForgotPassword extends Controller
{
    public $page_title = 'Forgot Password';
    public $title = SITE_NAME;
    public $message;

    public function show() {
        if (isset($_POST['reset'])) {
            $database = new Database();

            // Get form values
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            
            $sql = "SELECT id, email FROM users WHERE email = :email";
            $database->query($sql);
            $database->bind(':email', $email);
            
            $userInfo = $database->result();
            
            // Email doesn't exist
            if (empty($userInfo)) {
                $this->message = 'That email address was not found in our system!';
            } else {

                // Set email and id
                $userEmail = $userInfo['email'];
                $userId = $userInfo['id'];
                
                // Create a secure token for this forgot password request.
                $token = openssl_random_pseudo_bytes(16);
                $token = bin2hex($token);

                // Insert the request information into password_reset_request table.
                $sql = "INSERT INTO password_reset_request
                            (user_id, date_requested, token)
                        VALUES
                            (:user_id, :date_requested, :token)";
                
                $database->query($sql);
                $database->bind(':user_id', $userId);
                $database->bind(':date_requested', date("Y-m-d H:i:s"));
                $database->bind(':token', $token);

                $database->execute();
                
                // Get the ID of the row 
                $passwordRequestId = $database->lastInsertId();

                // Verify forgot password script
                $verifyScript = 'http://' . $_SERVER['HTTP_HOST'] . '/forgot-password-process';
                $linkToSend = $verifyScript . '?uid=' . $userId . '&id=' . $passwordRequestId . '&t=' . $token;
                
                // This would email in a production site
                $this->message = "<a href='$linkToSend'>Click here to reset</a>";
            }
        }
        $this->view('forgot-password');
    }
}
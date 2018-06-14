<?php

class ForgotPasswordProcess extends Controller {

    public function get() {
        $user = new User();
        $session = new Session();

        // User id, token, and request id
        $userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
        $token = isset($_GET['t']) ? trim($_GET['t']) : '';
        $passwordRequestId = isset($_GET['id']) ? trim($_GET['id']) : '';
        
        $requestInfo = $user->verifyPasswordRequest($userId, $passwordRequestId, $token);
        
        // Check if valid request
        if (empty($requestInfo)) {
            $this->redirect('forgot-password');
        } else {
            // Set session variable
            $session->setPasswordRequestId($userId);
            
            // Redirect them to your reset password form.
            $this->redirect('create-password');
        }
    }
}


<?php

class ForgotPasswordProcess extends Controller {

    public function get() {
        $user = new User();
        $get = filter_get();
        
        $requestInfo = $user->verifyPasswordRequest($get['uid'], $get['id'], $get['t']);
        
        // Check if valid request
        if (empty($requestInfo)) {
            $this->redirect('forgot-password');
        } else {
            // Set session variable
            $this->session->setPasswordRequestId($userId);
            
            // Redirect them to your reset password form.
            $this->redirect('create-password');
        }
    }
}


<?php

use Laconia\Controller;
use Laconia\ListClass;

class Settings extends Controller
{
    public $page_title = 'Settings';
    public $message;
    public $user;

    public function post() 
    {
        $this->session->authenticate();
        $get = filter_get();
        $post = filter_post();

        // Get user by session value
        $userId = $this->session->getSessionValue('user_id');

        // Update settings
        $this->userControl->updateUserSettings($post, $userId);

        // Load new settings
        $this->user = $this->userControl->getUser($userId);

        if (isset($post['email'])) {
            $this->message = SETTINGS_UPDATE_SUCCESS;
         
            echo $this->message;
        }

        if (isset($post['delete_user'])) {
            $this->userControl->deleteUser($userId);
            $this->session->logout();

            $this->message = USER_DELETED;
        
            echo $this->message;
        }
    }

    public function get() 
    {
        $this->session->authenticate();
        $get = filter_get();
        
        // Get user by session value
        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);

        $this->view('settings');
    }
}
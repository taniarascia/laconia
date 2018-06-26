<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
use Laconia\Controller;
use Laconia\ListClass;

class Settings extends Controller
{
    public $page_title = 'Settings';
    public $message;

    public function post() {
        $this->session->authenticate();
        $get = filter_get();
        $post = filter_post();
        $userId = $this->session->getSessionValue('user_id');

        $this->userControl->updateUserSettings($post, $userId);
        
        $userInfo = $this->userControl->getUser($userId);
        $this->user = $userInfo;

        $this->view('settings');
    }

    public function get() {
        $this->session->authenticate();
        $get = filter_get();
        
        $userId = $this->session->getSessionValue('user_id');
        $userInfo = $this->userControl->getUser($userId);
        $this->user = $userInfo;

        $this->view('settings');
    }
}
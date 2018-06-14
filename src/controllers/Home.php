<?php

class Home extends Controller
{
    public $page_title = 'Home';
    public $result;
    public $user;

    public function get() {
        $user = new User();
        $session = new Session();
        $session->authenticate();
        
        $userInfo = $user->getUser($session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->view('home');
    }
}
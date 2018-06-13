<?php

class Home extends Controller
{
    public $page_title = 'Home';
    public $result;
    public $user;

    public function get() {
        $this->authenticate();

        $user = new User();
        $userInfo = $user->getUser($_SESSION['user_id']);
        
        $this->user = $userInfo;
        $this->view('home');
    }
}
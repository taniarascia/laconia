<?php

class Home extends Controller
{
    public $page_title = 'Home';
    public $lists;

    public function get() {
        $user = new User();
        $list = new ListClass();
        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->lists = $list->getListsByUser($userInfo);

        $this->view('home');
    }
}
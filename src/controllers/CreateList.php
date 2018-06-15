<?php

class CreateList extends Controller
{
    public $page_title = 'CreateList';
    public $user;

    public function get() {
        $user = new User();
        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->view('create-list');
    }
}
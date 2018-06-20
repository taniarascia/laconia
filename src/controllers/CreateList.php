<?php

class CreateList extends Controller
{
    public $page_title = 'Create List';
    public $user;
    public $message;

    public function post() { 
        $user = new User();
        $list = new ListClass();
        $post = filter_post();

        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        $this->user = $userInfo;
        
        $result = $list->createList($userInfo, $post['title'], $post);

        if ($result) {
            $this->message = 'List created.';
        }

        $this->view('create-list');
    }

    public function get() {
        $user = new User();
        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->view('create-list');
    }
}
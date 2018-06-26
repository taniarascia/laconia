<?php

use Laconia\Controller;
use Laconia\ListClass;

class Create extends Controller
{
    public $page_title = 'Create List';
    public $user;
    public $message;

    public function post() { 
        $list = new ListClass();
        $post = filter_post();

        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $this->userControl->getUser($this->session->getSessionValue('user_id'));
        $this->user = $userInfo;
        
        $result = $list->createList($userInfo, $post['title'], $post);

        if ($result) {
            $this->message = LIST_CREATE_SUCCESS;
        } else {
            $this->message = LIST_CREATE_FAIL;
        }

        $this->view('create');
    }

    public function get() {
        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $this->userControl->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->view('create');
    }
}
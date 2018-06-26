<?php

use Laconia\Controller;
use Laconia\ListClass;

class Create extends Controller
{
    public $page_title = 'Create List';
    public $user;
    public $message;
    public $session;

    public function post() 
    { 
        $list = new ListClass();
        $post = filter_post();

        // Proceed if authentication passed
        $this->session->authenticate();
        
        // Get user info from session
        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);
        
        // Create a new list
        $result = $list->createList($this->user, $post['title'], $post);

        if ($result) {
            $this->message = LIST_CREATE_SUCCESS;
        } else {
            $this->message = LIST_CREATE_FAIL;
        }

        $this->view('create');
    }

    public function get() 
    {
        // Proceed if authentication passed
        $this->session->authenticate();
        
        // Get user info from session
        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);
        
        $this->view('create');
    }
}
<?php

use Laconia\Controller;
use Laconia\ListClass;

class CreateController extends Controller
{
    public $page_title = 'Create List';
    public $user;
    public $message;
    public $session;
    public $list;

    public function post() 
    { 
        $post = filter_post();

        // Get user info from session
        $userId = $this->session->getSessionValue('user_id');
        $this->session->authenticate($userId);
        
        $this->user = $this->userControl->getUser($userId);
        
        // Create a new list
        $result = $this->list->createList($this->user, $post['title'], $post);

        if ($result) {
            $this->message = LIST_CREATE_SUCCESS;
        } else {
            $this->message = LIST_CREATE_FAIL;
        }

        echo $this->message;
        exit;
    }

    public function get() 
    {
        // Get user info from session
        $userId = $this->session->getSessionValue('user_id');
        $this->session->authenticate($userId);

        $this->user = $this->userControl->getUser($userId);
        
        $this->view('create');
    }
}
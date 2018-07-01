<?php

use Laconia\Controller;
use Laconia\ListClass;

class HomeController extends Controller
{
    public $pageTitle = 'Home';
    public $lists;
    public $list;
    public $user;

    public function post() 
    {
        $userId = $this->session->getSessionValue('user_id');
        $this->session->authenticate($userId);
        
        $post = filter_post();
        
        $this->user = $this->userControl->getUser($userId);
        
        // Delete list item
        if (isset($post['delete'])) {
            $this->list->deleteList($post['list_id']);
            
            $this->message = LIST_DELETE_SUCCESS;
            echo $this->message;
            exit;
        }
    }

    public function get() 
    {
        $userId = $this->session->getSessionValue('user_id');
        // Proceed if authentication passed
        $this->session->authenticate($userId);
        
        $this->user = $this->userControl->getUser($userId);

        // Get lists
        $this->lists = $this->list->getListsByUser($this->user);

        $this->view('home');
    }
}
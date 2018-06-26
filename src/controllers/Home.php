<?php

use Laconia\Controller;
use Laconia\ListClass;

class Home extends Controller
{
    public $page_title = 'Home';
    public $lists;
    public $user;

    public function post() {
        $post = filter_post();
        $list = new ListClass();

        // Proceed if authentication passed
        $this->session->authenticate();

        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);

        // Delete list item
        if ($post['delete']) {
            $list->deleteList($post['list_id']);
        }

        // Get updated lists
        $this->lists = $list->getListsByUser($this->user);

        $this->view('home');
    }

    public function get() {
        $list = new ListClass();

        // Proceed if authentication passed
        $this->session->authenticate();
        
        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);

        // Get lists
        $this->lists = $list->getListsByUser($this->user);

        $this->view('home');
    }
}
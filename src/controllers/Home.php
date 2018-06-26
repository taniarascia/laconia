<?php

use Laconia\Controller;
use Laconia\ListClass;

class Home extends Controller
{
    public $page_title = 'Home';
    public $lists;
    public $user;

    public function post() {
        $list = new ListClass();
        $this->session->authenticate();

        $userInfo = $this->userControl->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $post = filter_post();

        if ($post['delete']) {
            $list->deleteList($post['list_id']);
        }
        $this->lists = $list->getListsByUser($userInfo);

        $this->view('home');
    }

    public function get() {
        $list = new ListClass();
        $this->session->authenticate();
        
        $userInfo = $this->userControl->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->lists = $list->getListsByUser($userInfo);

        $this->view('home');
    }
}
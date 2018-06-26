<?php

use Laconia\Controller;
use Laconia\ListClass;

class UserProfile extends Controller
{
    public $page_title;
    public $user;
    public $lists;
    public $list;

    public function get() 
    {
        $get = filter_get();
        $this->list = new ListClass();

        $this->user = $this->userControl->getUserByUsername($get['username-router']);

        $this->lists = $this->list->getListsByUser($this->user);
        $this->page_title = $this->user['username'];

        $this->view('user-profile');
    }
}
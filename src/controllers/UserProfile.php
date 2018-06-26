<?php

use Laconia\Controller;
use Laconia\ListClass;

class UserProfile extends Controller
{
    public $page_title;
    public $user;
    public $lists;
    public $list;

    public function get() {
        $this->list = new ListClass();
        $get = filter_get();

        $userInfo = $this->userControl->getUserByUsername($get['username-router']);
        $this->user = $userInfo;

        $this->lists = $this->list->getListsByUser($userInfo);
        $this->page_title = $this->user['username'];

        $this->view('user-profile');
    }
}
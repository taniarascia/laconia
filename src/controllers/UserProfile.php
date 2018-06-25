<?php

use Laconia\Controller;
use Laconia\ListClass;

class UserProfile extends Controller
{
    public $page_title = 'Profile';
    public $user;

    public function get() {
        $list = new ListClass();
        $get = filter_get();

        $userInfo = $this->userControl->getUserByUsername($get['username-router']);
        $this->user = $userInfo;

        $this->lists = $list->getListsByUser($userInfo);

        $this->view('user-profile');
    }
}
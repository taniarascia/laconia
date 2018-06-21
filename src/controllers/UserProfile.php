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

        print_r($get);

        $userInfo = $this->userControl->getUserByUsername($get['user_id']);
        $this->user = $userInfo;

        $this->view('user-profile');
    }
}
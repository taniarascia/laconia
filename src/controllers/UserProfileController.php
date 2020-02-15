<?php

use Laconia\Controller;
use Laconia\ListClass;

class UserProfileController extends Controller
{
    public $pageTitle;
    public $user;
    public $lists;
    public $list;

    public function get()
    {
        $get = filter_get();

        $this->user = $this->userControl->getUserByUsername($get['username-router']);
        $this->lists = $this->list->getListsByUser($this->user);
        $this->pageTitle = $this->user['username'];
       
        $this->view('user-profile');
    }
}

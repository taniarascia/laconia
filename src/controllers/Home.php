<?php

use Laconia\Controller;
use Laconia\ListClass;

class Home extends Controller
{
    public $page_title = 'Home';
    public $lists;

    public function get() {
        $list = new ListClass();
        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $this->userControl->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->lists = $list->getListsByUser($userInfo);

        $this->view('home');
    }
}
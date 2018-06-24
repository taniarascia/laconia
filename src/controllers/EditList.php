<?php

use Laconia\Controller;
use Laconia\ListClass;

class EditList extends Controller
{
    public $page_title = 'Edit List';
    public $user;
    public $editList;

    public function get() {
        $list = new ListClass();

        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $this->userControl->getUser($this->session->getSessionValue('user_id'));
        $this->user = $userInfo;

        $get = filter_get();

        $this->editList = $list->getListById($get['list_id']);

        $this->view('edit-list');
    }
}
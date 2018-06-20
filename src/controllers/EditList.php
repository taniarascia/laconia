<?php

class EditList extends Controller
{
    public $page_title = 'Edit List';
    public $user;
    public $editList;

    public function get() {
        $user = new User();
        $list = new ListClass();

        $this->session->authenticate();
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        $this->user = $userInfo;

        $get = filter_get();

        $this->editList = $list->getListById($get['list_id']);

        $this->view('edit-list');
    }
}
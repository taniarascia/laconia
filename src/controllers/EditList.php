<?php

class EditList extends Controller
{
    public $page_title = 'Edit List';
    public $user;
    public $message;

    public function get() {
        $user = new User();
        $this->session->authenticate();
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        $this->user = $userInfo;

        $get = filter_get();

        $result = $list->getListById($userInfo, $get['list_id'], $post);

        $this->view('edit-list');
    }
}
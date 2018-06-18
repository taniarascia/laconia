<?php

class CreateList extends Controller
{
    public $page_title = 'Create List';
    public $user;
    public $message;

    public function post() {
        $user = new User();
        $list = new ListClass();

        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;

        // Get form values
        $title = !empty($_POST['title']) ? trim($_POST['title']) : null;
        $list_item_1 = !empty($_POST['list_item_1']) ? trim($_POST['list_item_1']) : null;
        $list_item_2 = !empty($_POST['list_item_2']) ? trim($_POST['list_item_2']) : null;

        $listItems = [
            $list_item_1,
            $list_item_2
        ];

        $result = $list->createList($userInfo, $title, $listItems);

        if ($result) {
            $this->message = 'List created.';
        }

        $this->view('create-list');
    }

    public function get() {
        $user = new User();
        $this->session->authenticate();
        
        // Proceed if authentication passed
        $userInfo = $user->getUser($this->session->getSessionValue('user_id'));
        
        $this->user = $userInfo;
        $this->view('create-list');
    }
}
<?php

use Laconia\Controller;
use Laconia\ListClass;

class Edit extends Controller
{
    public $page_title = 'Edit List';
    public $editList;
    public $listTitle;
    public $message;

    public function post() {
        $get = filter_get();
        $post = filter_post();
        $list = new ListClass();

        // Proceed if authentication passed
        $this->session->authenticate();
        
        // Check if any rows were changed and notify
        $rowsAffected = $list->editList($post, $get['list_id']);

        if ($rowsAffected > 0) {
            $this->message = LIST_UPDATE_SUCCESS;
        }

        // Get updated values
        $this->editList = $list->getListItemsByListId($get['list_id']);
        $this->listTitle = $list->getListByListId($get['list_id']);

        $this->view('edit');
    }

    public function get() {
        $get = filter_get();
        $list = new ListClass();

        // Proceed if authentication passed
        $this->session->authenticate();
        
        // Get list values
        $this->editList = $list->getListItemsByListId($get['list_id']);
        $this->listTitle = $list->getListByListId($get['list_id']);

        $this->view('edit');
    }
}
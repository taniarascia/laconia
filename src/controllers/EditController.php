<?php

use Laconia\Controller;
use Laconia\ListClass;

class EditController extends Controller
{
    public $pageTitle = 'Edit List';
    public $editList;
    public $listTitle;
    public $message;
    public $list;
    public $csrf;

    public function post()
    {
        $get = filter_get();
        $post = filter_post();
        $this->session->validateCSRF($post['csrf']);

        $this->listTitle = $this->list->getListByListId($get['list_id']);
        $listUserId = $this->listTitle['user_id'];

        // Proceed if authentication passed
        $this->session->authenticate($listUserId);

        // Check if any rows were changed and notify
        $rowsAffected = $this->list->editList($post, $get['list_id']);

        if ($rowsAffected > 0) {
            $this->message = LIST_UPDATE_SUCCESS;

            echo $this->message;
            exit;
        } else {
            $this->message = LIST_UPDATE_FAIL;

            echo $this->message;
            exit;
        }
    }

    public function get()
    {
        $get = filter_get();
        $this->listTitle = $this->list->getListByListId($get['list_id']);
        $listUserId = $this->listTitle['user_id'];

        // Proceed if authentication passed
        $this->session->authenticate($listUserId);
        $this->csrf = $this->session->getSessionValue('csrf');

        // Get list values
        $this->editList = $this->list->getListItemsByListId($get['list_id']);
        $this->listTitle = $this->list->getListByListId($get['list_id']);

        $this->view('edit');
    }
}

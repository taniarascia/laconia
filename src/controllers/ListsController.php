<?php

use Laconia\Controller;

class ListsController extends Controller
{
    public $pageTitle = 'Lists';
    public $user;
    public $session;
    public $lists;
    public $list;
    public $csrf;


    public function post()
    {
        $post = filter_post();
        $this->session->validateCSRF($post['csrf']);
        $userId = $this->session->getSessionValue('user_id');
        $this->session->authenticate($userId);
        $this->user = $this->userControl->getUser($userId);

        // Delete list item
        if (isset($post['delete'])) {
            $this->list->deleteList($post['list_id']);

            $this->message = LIST_DELETE_SUCCESS;
            echo $this->message;
            exit;
        }
    }

    public function get()
    {
        // Get user info from session
        $userId = $this->session->getSessionValue('user_id');
        
        // Proceed if authentication passed
        $this->session->authenticate($userId);

        $this->user = $this->userControl->getUser($userId);
        $this->csrf = $this->session->getSessionValue('csrf');

        // Get lists
        $this->lists = $this->list->getListsByUser($this->user);

        $this->view('lists');
    }
}

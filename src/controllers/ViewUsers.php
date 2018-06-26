<?php

use Laconia\Controller;

class ViewUsers extends Controller
{
    public $page_title = "View Users";
    public $users;

    public function get() {
        $this->users = $this->userControl->getAllUsers();
        
        $this->view('view-users');
    }
}
<?php

use Laconia\Controller;

class UsersController extends Controller
{
    public $pageTitle = "View Users";
    public $users;

    public function get()
    {
        $this->users = $this->userControl->getAllUsers();

        $this->view('users');
    }
}

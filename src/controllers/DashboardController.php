<?php

use Laconia\Controller;
use Laconia\ListClass;

class DashboardController extends Controller
{
    public $pageTitle = 'Dashboard';
    public $lists;
    public $list;
    public $user;
    public $csrf;

    public function get()
    {
        $userId = $this->session->getSessionValue('user_id');

        // Proceed if authentication passed
        $this->session->authenticate($userId);

        $this->user = $this->userControl->getUser($userId);
        $this->csrf = $this->session->getSessionValue('csrf');

        $this->view('dashboard');
    }
}

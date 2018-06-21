<?php

use Laconia\Controller;

class Logout extends Controller
{
    public function get() {
        $this->session->logout();
        $this->redirect('');
    }
}
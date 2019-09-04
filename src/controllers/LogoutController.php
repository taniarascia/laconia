<?php

use Laconia\Controller;

class LogoutController extends Controller
{
    public function get()
    {
        $this->session->logout();
        $this->redirect('');
    }
}

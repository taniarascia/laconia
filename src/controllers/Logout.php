<?php

class Logout extends Controller
{
    public function get() {
        $session = new Session();
        $session->logout();
        $this->redirect('');
    }
}
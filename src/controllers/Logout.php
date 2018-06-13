<?php

class Logout extends Controller
{
    public function get() {
        $this->logout();
        $this->redirect('');
    }
}
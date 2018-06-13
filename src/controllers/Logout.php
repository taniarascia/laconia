<?php

class Logout extends Controller
{

    public function get() {
        unset($_SESSION);

        session_destroy();

        $this->redirect('');
    }
}
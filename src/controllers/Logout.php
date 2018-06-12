<?php

class Logout extends Controller
{

    public function show() {
        unset($_SESSION);

        session_destroy();

        header('Location: /');
    }
}
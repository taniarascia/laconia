<?php 

class Index extends Controller
{
    public function show() {

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
            // User not logged in
            header('Location: /login');
            exit;
        } else {
            // User logged in
            header('Location: /home');
        }
    }
}
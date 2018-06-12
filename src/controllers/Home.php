<?php

class Home extends Controller
{
    public $page_title = 'Home';
    public $title = SITE_NAME;
    public $row;

    public function show() {

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
            //User not logged in. Redirect them back to the login.php page.
            header('Location: /login');
            exit;
        }

        $database = new Database();
        $database->query("SELECT * FROM users WHERE id = :id LIMIT 1");
        $database->bind(':id', $_SESSION['user_id']);

        $this->row = $database->result();  

        $this->view('home');
    }
}
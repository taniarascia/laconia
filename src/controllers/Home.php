<?php

class Home extends Controller
{
    public $page_title = 'Home';
    public $title = SITE_NAME;
    public $row;

    public function get() {

        $this->authenticate();

        $database = new Database();
        $database->query("SELECT * FROM users WHERE id = :id LIMIT 1");
        $database->bind(':id', $_SESSION['user_id']);

        $this->row = $database->result();  

        $this->view('home');
    }
}
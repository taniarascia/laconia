<?php

// Meta
$page_title = 'Home';
$title = SITE_NAME . ' - ' . $page_title;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: /login');
    exit;
}

$database = new Database();
$database->query("SELECT * FROM users WHERE id = :id LIMIT 1");
$database->bind(':id', $_SESSION['user_id']);

$row = $database->result();  

require $root . '/src/views/home.view.php';
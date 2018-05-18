<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: /public/login.php');
    exit;
} else {
    header('Location: /public/home.php');
}

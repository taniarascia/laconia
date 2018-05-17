<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
} else {
    header('Location: home.php');
}

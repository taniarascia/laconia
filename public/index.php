<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    // User not logged in
    header('Location: /public/login.php');
    exit;
} else {
    // User logged in
    header('Location: /public/home.php');
}

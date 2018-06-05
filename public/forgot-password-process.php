<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/class.database.php';

// User id, token, and request id
$userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
$token = isset($_GET['t']) ? trim($_GET['t']) : '';
$passwordRequestId = isset($_GET['id']) ? trim($_GET['id']) : '';
 
$sql = "SELECT id, user_id, date_requested 
        FROM password_reset_request
        WHERE 
            user_id = :user_id AND 
            token = :token AND 
            id = :id";
 
$database->query($sql);
$database->bind(':user_id', $userId);
$database->bind(':id', $passwordRequestId);
$database->bind(':token', $token);

$requestInfo = $database->result();
 
// Check if valid request
if (empty($requestInfo)) {
    echo 'Invalid request!';
    exit;
}
 
// Set session variable
$_SESSION['user_id_reset_pass'] = $userId;
 
// Redirect them to your reset password form.
header('Location: create-password.php');
exit;
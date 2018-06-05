<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

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
 
$statement = $pdo->prepare($sql);
$statement->execute(array(
    "user_id" => $userId,
    "id" => $passwordRequestId,
    "token" => $token
));
 
$requestInfo = $statement->fetch(PDO::FETCH_ASSOC);
 
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
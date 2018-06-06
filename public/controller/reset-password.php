<?php

session_start();

// Meta
$page_title = 'Reset Password';
$title = SITE_NAME . ' - ' . $page_title;

if (isset($_POST['create'])) {
    $database = new Database();
    $resetPass = $_SESSION['user_id_reset_pass'];
    
    if (!$resetPass) {
        header('/login');
        exit;
    } else {
        $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
        // Hash the new password
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
        
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $database->query($sql);
        $database->bind(':password', $passwordHash);
        $database->bind(':id', $resetPass);
    
        $result = $database->execute();
        
        if ($result) {
            // Success
            $message = 'Your password has been updated. <a href="/login">Login</a>';
        }
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/public/views/reset-password.view.php';
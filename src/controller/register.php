<?php

// Meta
$page_title = 'Register';
$title = SITE_NAME . ' - ' . $page_title;

if (isset($_POST['register'])) {
    $database = new Database();
    
    // Get form values
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    // TO ADD: Error checking (username characters, password length, etc).
    
    // Check if username already exists
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $database->query($sql);
    $database->bind(':username', $username);

    $row = $database->result();

    // Username already exists error
    if ($row['num'] > 0) {
        $message = 'That username already exists! Try again.';
    } else {
    
        // Hash the password
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));

        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $database->query($sql);
        $database->bind(':username', $username);
        $database->bind(':password', $passwordHash);
        $database->bind(':email', $email);

        $result = $database->execute();
        
        // User registration successful
        if ($result) {
            $message = 'Thank you for registering with our website. <a href="/login">Login</a>';
        }
    }
}

require $root . '/src/views/register.view.php';
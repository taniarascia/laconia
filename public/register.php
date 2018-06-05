<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/class.database.php';

if (isset($_POST['register'])) {
    
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
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $database->query($sql);
        $database->bind(':username', $username);
        $database->bind(':password', $passwordHash);
        $database->bind(':email', $email);

        $result = $database->execute();
        
        // User registration successful
        if ($result) {
            $message = 'Thank you for registering with our website. <a href="/public/login.php">Login</a>';
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        
        <?php if ($message) : ?>
            <p><?= $message; ?></p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"><br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email"><br>
            <input type="submit" name="register" value="Register"></button>
        </form>
        <a href="/public">Home</a>  <a href="/public/login.php">Login</a>
    </body>
</html>
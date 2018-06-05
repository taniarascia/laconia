<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (isset($_POST['register'])) {
    
    // Get form values
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    
    // Check if username already exists
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Username already exists error
    if ($row['num'] > 0) {
        echo 'That username already exists! <a href="/public">Back</a>';
    }
    
    // Hash the password
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $passwordHash);
    $statement->bindValue(':email', $email);

    $result = $statement->execute();
    
    // User registration successful
    if ($result) {
        echo 'Thank you for registering with our website. <a href="/public/login.php">Login</a>';
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
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"><br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email"><br>
            <input type="submit" name="register" value="Register"></button>
        </form>
        <a href="/public">Home</a>
    </body>
</html>
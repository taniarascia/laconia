<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (isset($_POST['login'])) {
    
    // Get form values
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Could not find a user with that username
    if ($user === false) {
        echo 'Incorrect username / password combination! <a href="/public/home.php">Back</a>';
        exit;
    } else {
        // User account found.
        // Verify passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        if ($validPassword) {
            
            // User login session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            header('Location: /public/home.php');
            exit;
        } else {
            echo 'Incorrect username / password combination! <a href="/public/login.php">Back</a>';
            exit;
        }
    }
    
}
 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
    <a href="/public">Home</a> <a href="/public/register.php">Register</a> <a href="/public/forgot-password.php">Forgot Password</a>
</html>

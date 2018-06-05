<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/class.database.php';

if (isset($_POST['login'])) {
    
    // Get form values
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    // Retrieve the user account information for the given username.
    $database->query("SELECT id, username, password FROM users WHERE username = :username");
    $database->bind(':username', $username);
    
    $user = $database->result();
    
    // Could not find a user with that username
    if ($user === false) {
        $message = 'Incorrect username / password combination! <a href="/public/home.php">Back</a>';
    } else {

        // User account found.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        if ($validPassword) {
            
            // User login session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            header('Location: /public/home.php');
            exit;
        } else {
            $message = 'Incorrect username / password combination!';
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

        <?php if ($message) : ?>
            <p><?= $message; ?></p>
        <?php endif; ?>

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

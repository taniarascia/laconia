<?php

$_SESSION['user_id_reset_pass'] = $userId;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create New Password</title>
    </head>
    <body>
        <h1>Create New Password</h1>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
    <a href="/public">Home</a> <a href="/public/register.php">Register</a> <a href="/public/forgot-password.php">Forgot Password</a>
</html>

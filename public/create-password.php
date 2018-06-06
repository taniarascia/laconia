<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/class.database.php';

if (isset($_POST['create'])) {
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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create New Password</title>
    </head>
    <body>
        <h1>Create New Password</h1>
        
        <?php if ($message) : ?>
            <p><?= $message; ?>
        <?php endif; ?>

        <form action="" method="post">
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="create" value="Create Password">
        </form>
    </body>
    <a href="/public">Home</a> <a href="/register">Register</a> <a href="/forgot-password">Forgot Password</a>
</html>

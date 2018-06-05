<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (isset($_POST['reset'])) {

    // Get form values
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    $sql = "SELECT id, email FROM users WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();
    
    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Email doesn't exist
    if (empty($userInfo)) {
        echo 'That email address was not found in our system!';
        exit;
    }
    
    // Set email and id
    $userEmail = $userInfo['email'];
    $userId = $userInfo['id'];
    
    // Create a secure token for this forgot password request.
    $token = openssl_random_pseudo_bytes(16);
    $token = bin2hex($token);

    // Insert the request information into password_reset_request table.
    $sql = "INSERT INTO password_reset_request
                (user_id, date_requested, token)
            VALUES
                (:user_id, :date_requested, :token)";
    
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        "user_id"        => $userId,
        "date_requested" => date("Y-m-d H:i:s"),
        "token"          => $token
    ));
    
    // Get the ID of the row 
    $passwordRequestId = $pdo->lastInsertId();

    // Verify forgot password script
    $verifyScript = 'http://laconia.test/public/forgot-password-process.php';
    $linkToSend = $verifyScript . '?uid=' . $userId . '&id=' . $passwordRequestId . '&t=' . $token;
    
    echo "<a href='$linkToSend'>$linkToSend</a>";
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forgot Password</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="forgot-password.php" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="email"><br>
            <input type="submit" name="reset" value="Reset Password">
        </form>
    </body>
    <a href="/public">Home</a> <a href="/public/register.php">Register</a>
</html>
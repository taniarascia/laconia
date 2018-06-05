<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

// User logged in
echo 'You are logged in!';

$sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $_SESSION['user_id']);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);

?>

<h1><?= $row['username']; ?></h1>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>

    <tr>
        <td><?= $row['username']; ?></td>
        <td><?= $row['email']; ?></td>
    </tr>

</table>

<a href="/public/logout.php">Logout</a>